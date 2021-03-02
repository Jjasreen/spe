<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\SpeSurvey;
use App\Models\Student;
use Illuminate\Http\Request;

class SpeController extends Controller
{
    //
    public function view()
    {
        $spe_surveys = SpeSurvey::all();
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

        return view('spe_surveys.create',[
            'surveys' => $all_surveys,
            'tp' => $all_tp,
            'mn' => $module_name,
        ]);
    }

    public function processCreate(Request $request)
    {
        $survey_title = $request-> survey_title;
        $unit_code = $request ->input('unit_code');
        $teaching_period = $request ->input('teaching_period');
        $survey_upload_date = $request -> input('survey_upload_date');
        $module_id = $request -> input('module_id');

        $spe_surveys = new SpeSurvey();
        $spe_surveys->survey_title=$survey_title;
        $spe_surveys->unit_code = $unit_code;
        $spe_surveys->teaching_period = $teaching_period;
        $spe_surveys->survey_upload_date = $survey_upload_date;
        $spe_surveys->module_id = $module_id;

        
        $spe_surveys->save();


        return redirect('/spe_surveys');
    }

    public function update(SpeSurvey $spe_survey)
    {
        
        $all_surveys = Module::pluck('unit_code', 'unit_code');
        $all_tp = Student::pluck('teaching_period', 'teaching_period');
        $module_name = Module::pluck('module_name', 'id');

        return view('spe_surveys.update',[
            'surveys' => $spe_survey,
            'unit_code' => $all_surveys,
            'tp' => $all_tp,
            'mn' => $module_name,
        ]);
    }

    public function processUpdate($spe_surveys_id, Request $request) 
    {        
        $spe_surveys = SpeSurvey::find($spe_surveys_id);
        
        $spe_surveys -> survey_title = $request -> input('survey_title');
        $spe_surveys -> unit_code = $request -> input('unit_code');
        $spe_surveys -> teaching_period = $request -> input('teaching_period');
        $spe_surveys -> survey_upload_date = $request -> input('survey_upload_date');
        $spe_surveys -> module_id = $request -> input('module_id');
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
}
