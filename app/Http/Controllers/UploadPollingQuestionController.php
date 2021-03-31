<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Polling;
use App\Models\PollingQuestion;
use App\Models\Upload;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Auth;


class UploadPollingQuestionController extends Controller
{
    public function upload()
    {
        $uc_id = Auth::user()->unit_coordinators->id;
        $mn = Module::where('unit_coordinator_id', $uc_id)->pluck('module_name', 'id');
        return view('uploadpolques.upload', ['mn'=> $mn]);

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

        $polling = new Polling();
        $polling->unit_code = $request->input('unit_code');
        $polling->polling_title = $request->input('polling_title');
        $polling->polling_number = $request->input('polling_number');
        $polling->teaching_period = $request->input('teaching_period');
        $polling->polling_upload_date = $request->input('polling_upload_date');

        $module = Module::find($request->input('module_id'));
        $polling->module_id = $request->input('module_id');
        $polling->unit_coordinator_id = $module->unit_coordinator_id;
        $polling->save();


        //process the import
        (new FastExcel)->import('uploads/'.$filename, function($line) use ($polling) 
        {

        $question = new PollingQuestion();
        $question->question_type = $line['Question Type'];
        $question->polling_question = $line['Polling Question'];
        $question->polling_question_number = $line ['Polling Question Number'];
        $question->polling_id = $polling->id;     
        $question->save();





    });

    return "file uploaded";
}
}
