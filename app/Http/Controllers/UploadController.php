<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Team;
use App\Models\Upload;
use App\Models\Student;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class UploadController extends Controller
{
    //
    public function upload() {
        return view('uploads.upload');
    }

    public function processUpload(Request $request) {
        $extension = $request->upload->extension();
        $filename = time().'.'.$request->upload->getClientOriginalName();
        $request->upload->move(public_path('uploads'), $filename);

        $upload = new Upload();
        $upload->file_name = $filename;
        $upload->file_type = $extension;
        $upload->file_url = $filename;
        $upload->save();

        // process the import
        (new FastExcel)->import('uploads/'.$filename, function($line){
            $module = Module::where('unit_code', $line['Unit Code'])->first();
            $team_name = $line['Team Name'];
            $team = Team::where('team_name', $team_name)
                        ->where('module_id', $module->id)
                        ->first();
            if (!$team) {
                
              
                
                $team = new Team();
                $team->team_name = $line['Team Name'];
                $team->unit_code = $line['Unit Code'];
                $team->teaching_period = $line['Teach Period'];
                $team->module_id = $module->id;
                $team->save();
            }

            $student = new Student();
            $student->s_title = $line['Title'];
            $student->student_number = $line['Student Number'];
            $student->s_givenname = $line['Given Names'];
            $student->teaching_period = $line['Teach Period'];
            $student->s_email = $line['Email'];
        
      
            $student->save();
            $student->teams()->attach([$team->id =>[
                'role_type' => $line['Role Type']
            ]]);

        });




        return "file uploaded";
    }
}
