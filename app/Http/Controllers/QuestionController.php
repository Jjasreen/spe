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
     
        return view('spesurveyquestions.create',[     
            'survey' => $speSurvey,
        ]);
            
    }
    //PROCESS CREATION OF QUESTIONS
    public function processCreate(SpeSurvey $speSurvey, Request $request)
    {
        $survey_question = $request -> input('survey_question');
        $survey_question_number = $request->input('question_number');
        $survey_answer_one = $request -> input('survey_answer_one');
        $survey_answer_two = $request -> input('survey_answer_two');
        $survey_answer_three = $request -> input('survey_answer_three');
        $survey_answer_four = $request -> input('survey_answer_four');
        $survey_answer_five = $request -> input('survey_answer_five');
        $spe_survey_id = $speSurvey->id;

        $survey = new SpeSurveyQuestion();
        $survey->question_number = $survey_question_number;
        $survey->survey_question = $survey_question;
        $survey->survey_answer_one = $survey_answer_one;
        $survey->survey_answer_two = $survey_answer_two;
        $survey->survey_answer_three = $survey_answer_three;
        $survey->survey_answer_four =$survey_answer_four;
        $survey->survey_answer_five =$survey_answer_five;
        $survey->spe_survey_id = $speSurvey->id;
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
        $question->survey_answer_one = $request->input('survey_answer_one');
        $question->survey_answer_two = $request->input('survey_answer_two');
        $question->survey_answer_three = $request->input('survey_answer_three');
        $question->survey_answer_four = $request->input('survey_answer_four');
        $question->survey_answer_five = $request->input('survey_answer_five');
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
