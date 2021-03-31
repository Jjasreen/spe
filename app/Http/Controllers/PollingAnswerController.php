<?php

namespace App\Http\Controllers;

use App\Models\PollingAnswer;
use App\Models\PollingQuestion;
use App\Models\PollingStudent;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PollingAnswerController extends Controller
{
    //
    public function show($polling_uuid)
    {
        $pollingStudent = PollingStudent::where('uuid',$polling_uuid)->firstOrFail();
        if (Carbon::create($pollingStudent->end_date)->lessThan(Carbon::now())) {
            return "Polling expired";
        }
        $polling = $pollingStudent->polling;
        $student = $pollingStudent->student;

        $got_answer = PollingAnswer::where('student_id', $student->id)
        ->where('polling_id', $polling->id)
        ->count() > 0;
        if($got_answer == true)
        {
            return "Polling has already been submitted";
        }

        return view('student.polling.show',compact('polling','student','pollingStudent'));
    }

    public function submit($polling_uuid, Request $request)
    {

        $answers = $request->get('answer');
     
        $pollingStudent = PollingStudent::where('uuid',$polling_uuid)->firstOrFail();
        if (Carbon::create($pollingStudent->end_date)->lessThan(Carbon::now())) {
            return "Polling expired";
        }
        $pollingStudent->completed = 1;
        $pollingStudent->save();
        $polling = $pollingStudent->polling;
        $student = $pollingStudent->student;
        
        $answer = $answers[array_key_first($answers)];
        
        
            foreach($answer as $key => $item)
            {
                $question = PollingQuestion::find($key);
                $polling_question = $question->polling_question;
                $question_type = $question->question_type;
                $answer['question_'.$key] = [
                    'question_id' => $key,
                    'question' => $polling_question,
                    'type' => $question_type,
                    'answer' => $item,
                ];
                unset($answer[$key]);

            }

            $polling_answer = new PollingAnswer();              
            $polling_answer->student_id = $student->id; // student doing the survey
            $polling_answer->polling_id = $polling->id;
            $polling_answer->answers = json_encode($answer);
            $polling_answer->save();


        

        return 'success';
    }
      

}
