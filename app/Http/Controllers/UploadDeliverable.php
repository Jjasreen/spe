<?php

namespace App\Http\Controllers;

use App\Models\DeliverableStudent;
use App\Models\DeliverableSubmission;
use App\Models\Module;
use App\Models\Team;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UploadDeliverable extends Controller
{
    public function upload($uuid)
    {
        $deliverablestudent = DeliverableStudent::where('uuid', $uuid)->firstOrFail();
        if (Carbon::create($deliverablestudent->end_date)->lessThan(Carbon::now())) {
            return "Submission expired";
        }

        if($deliverablestudent -> completed == true)
        {
            return "Submission has already been submitted";

        }

        return view('uploaddeliverable.upload', ['deliverablestudent'=> $deliverablestudent]);
    }

    public function processUpload(Request $request, $uuid)
    {
        
        $filename = time().'.'.$request->upload->getClientOriginalName();
        $request->upload->move(public_path('uploads'), $filename);

        $deliverablestudent = DeliverableStudent::where('uuid', $uuid)->firstOrFail();
        $deliverablestudent->completed = 1;
        $deliverablestudent->save();

        $upload = new DeliverableSubmission();
        $upload->file_name = $filename;
        $upload->submission_upload_date = Carbon::now();
        $upload->submission_title = $request -> input ('submission_title');
        $upload->team_id = Team::where('module_id', $deliverablestudent->module_id)
                            ->whereHas('students', function ($q) use ($deliverablestudent){
                                $q->where('student_id', $deliverablestudent->student_id);
                            })
                            ->first()->id;       
        
                            
        $module = Module::find( $deliverablestudent->module_id);
        $upload->unit_coordinator_id = $module->unit_coordinator_id;
        $upload->save();

        // Second upload

        $filename = time().'.'.$request->upload2->getClientOriginalName();
        $request->upload2->move(public_path('uploads'), $filename);


        $upload = new DeliverableSubmission();
        $upload->file_name = $filename;
        $upload->submission_upload_date = Carbon::now();
        $upload->submission_title = $request -> input ('submission_title');
        $upload->team_id = Team::where('module_id', $deliverablestudent->module_id)
                            ->whereHas('students', function ($q) use ($deliverablestudent){
                                $q->where('student_id', $deliverablestudent->student_id);
                            })
                            ->first()->id;       
        
                            
        $module = Module::find( $deliverablestudent->module_id);
        $upload->unit_coordinator_id = $module->unit_coordinator_id;
        $upload->save();
   
    
       return "file uploaded";

    }



}
