<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Polling;
use App\Models\UnitCoordinator;
use App\Models\Student;
use App\Models\PollingQuestion;
use App\Models\PollingAnswer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PollingEmail;
use App\Models\PollingStudent;
use Mailejet\LaravelMailjet\Facades\Mailjet;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PollingController extends Controller
{
    // Show the pollings for a given module
    public function view(Module $module)
    {
        $polling = Polling::where('module_id', $module->id)->get();
        return view('polling.view',[
            'polling' => $polling]);
    }

    public function details(Polling $polling)
    {
        return view('polling.details',[
            'polling' => $polling
            ]);
    }

    public function create()
    {
        $polling_unit_code = Module::pluck('unit_code', 'unit_code');
        $all_teaching_period = Student::pluck('teaching_period', 'teaching_period');
        $unit_coordinator_id = UnitCoordinator::pluck('id', 'id');
        $module_name = Module::pluck('module_name', 'id');

        return view('polling.create',[
            'p_unit_code' => $polling_unit_code,
            'tp' => $all_teaching_period,
            'uc_id' => $unit_coordinator_id,
            'mn' => $module_name,
        ]);
    }

    public function processCreate(Request $request)
    {
        $polling_title = $request-> polling_title;
        $polling_number = $request-> polling_number;
        $unit_code = $request ->input('unit_code');
        $teaching_period = $request ->input('teaching_period');
        $polling_upload_date = $request -> input('polling_upload_date');
        $unit_coordinator_id = $request -> input('unit_coordinator_id');
        $module_id = $request -> input('module_id');

        $polling = new Polling();
        $polling->polling_title = $polling_title;
        $polling->polling_number = $polling_number;
        $polling->unit_code = $unit_code;
        $polling->teaching_period = $teaching_period;
        $polling->polling_upload_date = $polling_upload_date;
        $polling->unit_coordinator_id = $unit_coordinator_id;
        $polling->module_id = $module_id;


        $polling->save();


        return redirect('/polling');
    }

    public function update(Polling $polling)
    {
        $polling_unit_code = Module::pluck('unit_code', 'unit_code');
        $all_teaching_period = Student::pluck('teaching_period', 'teaching_period');
        $unit_coordinator_id = UnitCoordinator::pluck('id', 'id');
        $module_name = Module::pluck('module_name', 'id');

        return view('polling.update',[
            'polling' => $polling,
            'p_unit_code' => $polling_unit_code,
            'tp' => $all_teaching_period,
            'uc_id' => $unit_coordinator_id,
            'mn' => $module_name,
        ]);
    }

    public function processUpdate($polling_id, Request $request)
    {
        $polling = Polling::find($polling_id);

        $polling -> polling_title = $request -> input('polling_title');
        $polling -> polling_number = $request -> input('polling_number');
        $polling -> unit_code = $request -> input('unit_code');
        $polling -> teaching_period = $request -> input('teaching_period');
        $polling -> polling_upload_date = $request -> input('polling_upload_date');
        $polling -> unit_coordinator_id = $request -> input('unit_coordinator_id');
        $polling -> module_id = $request -> input('module_id');
        $polling->save();

        return redirect('/polling');
    }

    public function delete($id)
    {
        $polling = Polling::find($id);
        return view('polling.delete',['polling' => $polling]);
    }

    public function processDelete($id)
    {
        $polling = Polling::find($id);
        $polling->delete();
        return redirect('/polling');
    }

    public function updateStudents(Polling $spePolling) {
        $students = Student::pluck('s_givenname', 'id');
        return view('polling.update_students',[
            'students' => $students,
            'current_students' => $spePolling->students->pluck('id'),
            'spePolling' => $spePolling
        ]);

    } 

    public function processUpdateStudents(Polling $spePolling, Request $request) {
        $students = $request->input('students');
        $spePolling->students()->sync($students);

        return redirect('/polling/'.$spePolling->id.'/details');
    }

    public function overview(Polling $spePolling){

        $student_surveys = PollingStudent::where('polling_id', $spePolling->id)->first();

        return view('polling.overview', compact('student_surveys', 'spePolling'));

    }

    public function manage(Polling $spePolling){

        $students = Student::all();

        return view('polling.manage', compact('students', 'spePolling'));

    }

    public function sendEmails(Polling $spePolling, Request $request){

       


        // get all selected students
        $students = Student::whereIn('id', $request->get('students'))->get();
        $user = Auth::user();
        $uc = UnitCoordinator::where('user_id', $user->id)->first();


        // send unique survey email out to each student
        foreach($students as $student){



            $polling_student = new PollingStudent();
            $polling_student->uuid = Str::uuid('sur');
            $polling_student->student_id = $student->id;
            $polling_student->polling_id = $spePolling->id;
            $polling_student->unit_coordinator_id = $uc->id; //eventually change to who is logged on 
            $polling_student->sent_by = $uc->id; // arbitrary fixed now until auth set up
            $polling_student->completed = 0; // not completed / change status once student completes survey
            $polling_student->end_date = Carbon::now()->addDays(14);
            $polling_student->save();

           Mail::to($student->s_email)
               ->send(new PollingEmail($polling_student));
        }

        return "wow. email sent.";


    }


}
