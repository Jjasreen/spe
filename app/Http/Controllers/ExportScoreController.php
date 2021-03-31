<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\SpeAnswer;
use App\Models\SpeScore;
use App\Models\SpeSurvey;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Auth;

class ExportScoreController extends Controller
{
    //
    public function export()
    {
        $uc_ids = Auth::user()->unit_coordinators()->pluck('id')->toArray();
        // $spe_surveys = SpeSurvey::all();
        $spe_surveys =  SpeSurvey::whereHas('module',  function($q) use ($uc_ids){
            $q->whereIn('unit_coordinator_id',$uc_ids);
        })->pluck("survey_title", 'id');
        return view('exportscore.export',['surveys'=> $spe_surveys]);
    }

    public function processExport(Request $request)
    {

        $survey = $request-> input('survey_id');
        
        // I want all the models of a certain table
        // to match a criteria
        // SELECT * from spe_survey_scores WHERE survey_id = $survey
        $scores = SpeScore::where('spe_survey_id', $survey)->get();
        foreach ($scores as &$score) {
            $student_id = $score->student_id;
            $got_answer = SpeAnswer::where('student_id', $student_id)
                ->where('spe_survey_id', $survey)
                ->count() > 0;

            if ($got_answer==false) {
                $score->spe_total_scores = 0;
            }

        }

        return (new FastExcel($scores))->download('file.xlsx');



    }


}
