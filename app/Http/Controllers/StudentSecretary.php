<?php

namespace App\Http\Controllers;

use App\Mail\SecretaryEmail;
use App\Models\DeliverableStudent;
use App\Models\DeliverableSubmission;
use App\Models\Student;
use App\Models\Team;
use App\Models\Module;
use App\Models\UnitCoordinator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Mailejet\LaravelMailjet\Facades\Mailjet;

class StudentSecretary extends Controller
{
    //select secretary email based on database

    public function getSecretary($module_id) {

        $teams = Team::where('module_id', $module_id)->pluck('id');
        
        $secretaries = Student::whereHas('teams', function($q) use ($teams){
            $q->where('role_type', 'Secretary')
              ->whereIn('team_id', $teams);
        })->get();
    }
    
    public function overview(Module $module){

        $teams = Team::where('module_id', $module->id)->pluck('id');
        
        $secretaries = Student::with('teams')->whereHas('teams', function($q) use ($teams){
            $q->where('role_type', 'Secretary')
              ->whereIn('team_id', $teams);
        })->get();

        return view('deliverablesubmission.overview', compact('secretaries', 'module'));

    }

    public function manage(Module $module){

        $teams = Team::where('module_id', $module->id)->pluck('id');
        
        $secretaries = Student::with('teams')->whereHas('teams', function($q) use ($teams){
            $q->where('role_type', 'Secretary')
              ->whereIn('team_id', $teams);
        })->get();

        return view('deliverablesubmission.manage', compact('secretaries', 'module'));

    }

    
    public function sendEmails(Module $module, Request $request){

       


        // get all selected students
        $students = Student::whereIn('id', $request->get('students'))->get();
        $user = Auth::user();
        $uc = UnitCoordinator::where('user_id', $user->id)->first();


        // send unique survey email out to each student
        foreach($students as $student){

            $secretary_student = new DeliverableStudent();
            $secretary_student->uuid = Str::uuid('sur');
            $secretary_student->submission_open_date = Carbon::now();
            $secretary_student->student_id = $student->id;
            $secretary_student->module_id = $module->id;
            $secretary_student->unit_coordinator_id = $uc->id; //eventually change to who is logged on 
            $secretary_student->sent_by = $uc->id; // arbitrary fixed now until auth set up
            $secretary_student->completed = 0; // not completed / change status once student completes survey
            $secretary_student->end_date = Carbon::now()->addDays(14);
            $secretary_student->save();

           Mail::to($student->s_email)
               ->send(new SecretaryEmail($secretary_student));
        }

        return "wow. email sent.";


    }

}
