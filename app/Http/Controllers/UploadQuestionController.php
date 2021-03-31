<?php

namespace App\Http\Controllers;

use App\Mail\SurveyEmail;
use App\Models\Module;
use App\Models\Team;
use App\Models\Upload;
use App\Models\Student;
use App\Models\SpeSurveyQuestion;
use App\Models\SpeSurvey;
use App\Models\SpeAnswer;
use App\Models\SpeScore;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Auth;

class UploadQuestionController extends Controller
{
    //
    public function upload()
    {
        $uc_id = Auth::user()->unit_coordinators->id;
        $mn = Module::where('unit_coordinator_id', $uc_id)->pluck('module_name', 'id');
        return view('uploadsques.upload', ['mn'=> $mn]);
    }

    public function processUpload(Request $request)
    {
        $extension = $request->upload->extension();
        $filename = time().'.'.$request->upload->getClientOriginalName();
        $request->upload->move(public_path('uploads'), $filename);

        $upload = new Upload();
        $upload->file_name = $filename;
        $upload->file_type = $extension;
        $upload->file_url = $filename;
        $upload->save();

        $survey = new SpeSurvey();

        $survey->survey_description = $request->input('survey_description');
        $survey->spe_survey_number = $request->input('spe_survey_number');
        $survey->survey_title = $request->input('survey_title');
        $survey->unit_code = $request->input('unit_code');
        $survey->teaching_period = $request->input('teaching_period');
        $survey->survey_upload_date = $request->input('survey_upload_date');


        $module = Module::find($request->input('module_id'));
        $survey->module_id = $request->input('module_id');
        $survey->unit_coordinator_id = $module->unit_coordinator_id;
        $survey->save();

        //process the import
        (new FastExcel)->import('uploads/'.$filename, function($line) use ($survey)
         {
            

        $question = new SpeSurveyQuestion();
        $question->question_type = $line['Question Type'];
        $question->survey_question = $line['Survey Question'];
        $question->question_number = $line ['Question Number'];
        $question->spe_survey_id = $survey->id;     
        $question->save();

    

        });



        return "file uploaded";

    }

} 