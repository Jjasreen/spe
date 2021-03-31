<?php

namespace App\Http\Controllers;
use App\Models\PollingQuestion;
use App\Models\PollingAnswer;
use App\Models\Polling;

use Illuminate\Http\Request;

class PollingQuestionController extends Controller
{
    //Show questions for that particular polling
    public function show(Polling $polling)
    {
        return view('pollingquestions.show',[
            'polling' => $polling
        ]);
    }

    //Create questions for that particular polling
    public function create(Polling $polling)
    {
        $question_types = ['text' => 'Text' , 'scale' => 'Scale'];
        return view('pollingquestions.create',[
            'polling' => $polling,
            'question_types' => $question_types
        ]);


    }

    //Process creation of questions
    public function processCreate(Polling $polling, Request $request)
    {
        $polling_question = $request -> input('polling_question');
        $polling_question_number = $request -> input ('polling_question_number');
        $question_type = $request -> input('question_type');
        $polling_id = $polling->id;

        $pollingQ = new PollingQuestion();
        $pollingQ->polling_question_number =$polling_question_number;
        $pollingQ->polling_question = $polling_question;
        $pollingQ->question_type = $question_type;
        $pollingQ->polling_id = $polling_id; 

        $pollingQ->save();

        return redirect('/pollingquestions/'.$polling->id.'/show');

    }

    //update particular questions in polling
    public function update(PollingQuestion $question)
    {

        return view('pollingquestions.update',[     
            'question' => $question,
        ]);

    }

    public function processUpdate(PollingQuestion $question, Request $request)
    {
        $question->polling_question = $request -> input('polling_question');
        $question->polling_question_number = $request -> input('polling_question_number');
        $question->save();

        return redirect('/pollingquestions/'.$question->polling_id.'/show');

    }

    public function delete($id)
    {
        $question = PollingQuestion::find($id);
        return view('pollingquestions.delete',
        ['question' => $question]);
    }
    public function processDelete($id)
    {   
        $question = PollingQuestion::find($id);
        $question->delete();
        return redirect('/pollingquestions/'.$question->polling_id.'/show');
    }
}
