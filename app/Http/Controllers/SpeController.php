<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Support\Str;
use App\Models\SpeSurvey;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\SpeStudent;
use Illuminate\Support\Facades\Mail;
use App\Mail\SurveyEmail;
use App\Models\UnitCoordinator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Mailejet\LaravelMailjet\Facades\Mailjet;




class SpeController extends Controller
{
    //
    public function view(Request $request)
    {


        $uc_ids = Auth::user()->unit_coordinators()->pluck('id')->toArray();
        // $spe_surveys = SpeSurvey::all();
        $spe_surveys =  SpeSurvey::whereHas('module',  function($q) use ($uc_ids){
            $q->whereIn('unit_coordinator_id',$uc_ids);
        });

        if ($request->has('module_id')) {
            $spe_surveys->where('module_id', $request->get('module_id'));
        }

        $spe_surveys = $spe_surveys->get();
        
        return view('spe_surveys.view',[
            'spe_surveys'=> $spe_surveys]);
    }

    public function details(SpeSurvey $spe_surveys)
    {
        return view('spe_surveys.details',[
            'spe_surveys' => $spe_surveys
            ]);
    }

    public function create()
    {
        $all_surveys = Module::pluck('unit_code', 'unit_code');
        $all_tp = Student::pluck('teaching_period', 'teaching_period');
        $module_name = Module::pluck('module_name', 'id');
        $unit_coordinator_id = UnitCoordinator::pluck('id', 'id');

        return view('spe_surveys.create',[
            'surveys' => $all_surveys,
            'tp' => $all_tp,
            'mn' => $module_name,
            'uc' => $unit_coordinator_id
        ]);
    }

    public function processCreate(Request $request)
    {
        $survey_title = $request-> survey_title;
        $spe_survey_number = $request -> spe_survey_number;
        $unit_code = $request ->input('unit_code');
        $survey_description = $request -> input('survey_description');
        $teaching_period = $request ->input('teaching_period');
        $survey_upload_date = $request -> input('survey_upload_date');
        $module_id = $request -> input('module_id');
        $unit_coordinator_id = UnitCoordinator::where('user_id', Auth::user()->id)->first()->id;

        $spe_surveys = new SpeSurvey();
        $spe_surveys->survey_title=$survey_title;
        $spe_surveys->spe_survey_number=$spe_survey_number;
        $spe_surveys->survey_description = $survey_description;
        $spe_surveys->unit_code = $unit_code;
        $spe_surveys->teaching_period = $teaching_period;
        $spe_surveys->survey_upload_date = $survey_upload_date;
        $spe_surveys->module_id = $module_id;
        $spe_surveys->unit_coordinator_id = $unit_coordinator_id;

        $spe_surveys->save();


        return redirect('/spe_surveys');
    }

    public function update(SpeSurvey $spe_survey)
    {

        $all_surveys = Module::pluck('unit_code', 'unit_code');
        $all_tp = Student::pluck('teaching_period', 'teaching_period');
        $module_name = Module::pluck('module_name', 'id');
        $unit_coordinator_id = UnitCoordinator::pluck('id', 'id');

        return view('spe_surveys.update',[
            'surveys' => $spe_survey,
            'unit_code' => $all_surveys,
            'tp' => $all_tp,
            'mn' => $module_name,
            'uc' => $unit_coordinator_id
        ]);
    }

    public function processUpdate($spe_surveys_id, Request $request)
    {
        $spe_surveys = SpeSurvey::find($spe_surveys_id);

        $spe_surveys -> survey_title = $request -> input('survey_title');
        $spe_surveys -> spe_survey_number = $request -> input('spe_survey_number');
        $spe_surveys -> unit_code = $request -> input('unit_code');
        $spe_surveys -> teaching_period = $request -> input('teaching_period');
        $spe_surveys -> survey_upload_date = $request -> input('survey_upload_date');
        $spe_surveys -> module_id = $request -> input('module_id');
        $spe_surveys -> unit_coordinator_id = $request -> input('unit_coordinator_id');
        $spe_surveys->save();

        return redirect('/spe_surveys');
    }

    public function delete($id)
    {
        $spe_surveys = SpeSurvey::find($id);
        return view('spe_surveys.delete',['spe_surveys' => $spe_surveys]);
    }
    public function processDelete($id)
    {
        $spe_surveys = SpeSurvey::find($id);
        $spe_surveys->delete();
        return redirect('/spe_surveys');
    }

    public function updateStudents(SpeSurvey $speSurvey) {
        $students = Student::pluck('s_givenname', 'id');
        return view('spe_surveys.update_students',[
            'students' => $students,
            'current_students' => $speSurvey->students->pluck('id'),
            'speSurvey' => $speSurvey
        ]);

    }

    public function processUpdateStudents(SpeSurvey $speSurvey, Request $request) {
        $students = $request->input('students');
        $speSurvey->students()->sync($students);

        return redirect('/spe_surveys/'.$speSurvey->id.'/details');
    }

    public function overview(SpeSurvey $speSurvey){

        $student_surveys = SpeStudent::where('spe_survey_id', $speSurvey->id)->first();

        return view('spe_surveys.overview', compact('student_surveys', 'speSurvey'));

    }

    public function manage(SpeSurvey $speSurvey){

        $students = Student::whereHas('survey', function($q) use ($speSurvey)
        {
            $q->where('spe_surveys.id',$speSurvey->id);
        })->get();

        return view('spe_surveys.manage', compact('students', 'speSurvey'));

    }

    public function sendEmails(SpeSurvey $speSurvey, Request $request){

       


        // get all selected students
        $students = Student::whereIn('id', $request->get('students'))->get();
        $user = Auth::user();
        $uc = UnitCoordinator::where('user_id', $user->id)->first();


        // send unique survey email out to each student
        foreach($students as $student){



            $survey_student = new SpeStudent();
            $survey_student->uuid = Str::uuid('sur');
            $survey_student->student_id = $student->id;
            $survey_student->spe_survey_id = $speSurvey->id;
            $survey_student->unit_coordinator_id = $uc->id; //eventually change to who is logged on 
            $survey_student->sent_by = $uc->id; // arbitrary fixed now until auth set up
            $survey_student->completed = 0; // not completed / change status once student completes survey
            $survey_student->end_date = Carbon::now()->addDays(14);
            $survey_student->save();

           Mail::to($student->s_email)
               ->send(new SurveyEmail($survey_student));
        }

        return "wow. email sent.";


    }


}
