<?php

namespace App\Http\Controllers;

use App\Models\SpeSurveyQuestion;
use App\Models\SpeSurvey;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    // SHOW QUESTIONS FOR THAT PARTICULAR SURVEY
    public function show(SpeSurvey $speSurvey)
    {
        return view('spesurveyquestions.show',[
        'speSurvey' => $speSurvey]);
    }
    
    //CREATE QUESTIONS FOR THAT PARTICULAR SURVEY
    public function create(SpeSurvey $speSurvey) 
    {

        $question_types = ['text' => 'Text', 'scale' => 'Scale'];
        return view('spesurveyquestions.create',[     
            'survey' => $speSurvey,
            'question_types' => $question_types
        ]);
            
    }
    //PROCESS CREATION OF QUESTIONS
    public function processCreate(SpeSurvey $speSurvey, Request $request)
    {
        $survey_question = $request -> input('survey_question');
        $survey_question_number = $request->input('question_number');
        $question_type = $request->input('question_type');
        $spe_survey_id = $speSurvey->id;

        $survey = new SpeSurveyQuestion();
        $survey->question_number = $survey_question_number;
        $survey->survey_question = $survey_question;
        $survey->question_type = $question_type;
        $survey->spe_survey_id = $spe_survey_id;
        

        

        $survey->save();

        return redirect('/questions/'.$speSurvey->id.'/show');
        

    }

    //UPDATE PARTICULAR QUESTIONS IN SURVEY
    public function update(SpeSurveyQuestion $question)
    {
        return view('spesurveyquestions.update',[     
            'question' => $question,
        ]);
    }

    public function processUpdate(SpeSurveyQuestion $question, Request $request)
    {

        $question->survey_question = $request->input('survey_question');
        $question->question_number = $request->input('question_number');
        $question->save();


        return redirect('/questions/'.$question->spe_survey_id.'/show');

    }

    public function delete($id)
    {
        $question = SpeSurveyQuestion::find($id);
        return view('spesurveyquestions.delete',
        ['question' => $question]);
    }

    public function processDelete($id)
    {
        $question = SpeSurveyQuestion::find($id);
        $question->delete();
        return redirect('/questions/'.$question->spe_survey_id.'/show');
        
    }
}
