<?php

namespace App\Http\Controllers;

use App\Mail\DisputeCaseEmail;
use App\Models\DisputeCase;
use App\Models\DisputeCaseRequest;
use App\Models\Module;
use App\Models\Polling;
use App\Models\Student;
use App\Models\Team;
use App\Models\UnitCoordinator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Mail;
use Str;

class DisputeCaseController extends Controller
{
    //
    public function view(Request $request)
    {
        
        $uc_ids = Auth::user()->unit_coordinators()->pluck('id')->toArray();
        $disputecase = DisputeCase::whereHas('module', function($q) use ($uc_ids){
            $q->whereIn('unit_coordinator_id',$uc_ids);
        });

        if ($request->has('module_id'))
        {
            $disputecase->where('module_id', $request->get('module_id'));
        }

        $disputecase = $disputecase->get();

        return view('disputecase.view',[
            'disputecase'=> $disputecase]);

    }

    public function create($uuid)
    {
        $disputecase = DisputeCaseRequest::with('module')->where('uuid', $uuid)->first();
        return view('disputecase.create',[
            'disputecase'=> $disputecase]);

    }

    public function processCreate($uuid, Request $request)
    {
        $disputeCaseRequest = DisputeCaseRequest::where('uuid', $uuid)->first();
        $team = Team::whereHas('students', function($q) use ($disputeCaseRequest) {
            $q->where('students.id', $disputeCaseRequest->student_id);
        })
        ->where('module_id', $disputeCaseRequest->module_id)
        ->first();

        $case_title = $request -> input ('case_title');
        $case_description = $request -> input ('case_description');
        $disputecase = new DisputeCase();
        $disputecase->case_title = $case_title;
        $disputecase->case_date = Carbon::now();
        $disputecase->case_status = 'open';
        $disputecase->case_description = $case_description;
        $disputecase->module_id = $disputeCaseRequest->module_id;
        $disputecase->student_id = $disputeCaseRequest->student_id;
        $disputecase->team_id = $team->id;
        $disputecase->unit_coordinator_id = $disputeCaseRequest->unit_coordinator_id;
        $disputecase->save();

        return('Dispute Case Created!');


    }

    public function details(DisputeCase $disputecase) {
        return view('disputecase.details',[
            'disputecase' => $disputecase
        ]);
    }

    public function manage($module_id)
    {
        

        $students = Student::whereHas('teams', function($q) use ($module_id){
            $q->where('student_team.role_type', '=', 'Secretary')
            ->where('module_id', '=', $module_id);
        })->get();

        return view('disputecase.manage', compact('students','module_id'));

    } 

    public function sendEmails($module_id, Request $request){

       


        // get all selected students
        $students = $request->input('students');
        $user = Auth::user();
        $uc = UnitCoordinator::where('user_id', $user->id)->first();


        // send unique survey email out to each student
        foreach($students as $student){


            $theStudent = Student::find($student);
            $case_student = new DisputeCaseRequest();
            $case_student->uuid = Str::uuid('sur');
            $case_student->student_id = $student;
            $case_student->module_id = $module_id;
            $case_student->unit_coordinator_id = $uc->id; //eventually change to who is logged on 
            $case_student->save();

           Mail::to($theStudent->s_email)
               ->send(new DisputeCaseEmail($case_student));
        }

        return "wow. email sent.";


    }




}
