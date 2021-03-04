<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SpeSurvey;
use Illuminate\Http\Request;

class SpeStudController extends Controller
{
    public function show($student_id, $spe_survey_id)
    {
        $student = Student::firstOrFail($student_id);
        $survey = SpeSurvey::with('spe_survey_questions')->firstOrFail($spe_survey_id);

        return View('spestud.show', compact('survey','spe_survey_questions'));

    }
    public function submit()
    {


    }
}
