<?php

namespace App\Http\Controllers;

use App\Models\AlertCase;
use App\Models\Module;
use App\Models\SpeAnswer;
use App\Models\SpeSurvey;
use App\Models\SpeScore;
use App\Models\SpeFinalScore;
use App\Models\SpeSurveyQuestion;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\SpeStudent;
use Carbon\Carbon;

class SpeAnswerController extends Controller
{
    // Version 1
//    public function show($survey_id, $student_id)
//    {
//        $survey = SpeSurvey::with('spe_survey_questions')->find($survey_id);
//        $student = Student::with('teams')->find($student_id);
//
//        $teammates = $student->teams->first()->students;
//        $teammates = $teammates->filter(function($value, $key) use ($student){
//           return $value->id !== $student->id;
//        }); // remove current student from teammates collection so there's no double counting
//
//        return view('student.survey.show', compact('survey', 'student', 'teammates'));
//    }

    // Version 2
    public function show($uuid)
    {



        $speStudent = SpeStudent::where('uuid', $uuid)->firstOrFail();
        if (Carbon::create($speStudent->end_date)->lessThan(Carbon::now())) {
            return "Survey expired";
        }
        $survey = $speStudent->speSurvey;
        $student = $speStudent->student;
        
        // laravel querybuilder
        // select count(*) from spe_scores where student_id = $student->id and survey_id = $survey->id
        // if the count is more than 0, means the student took before
        // return "you already did the survey"
        
        $got_answer = SpeAnswer::where('student_id', $student->id)
        ->where('spe_survey_id', $survey->id)
        ->count() > 0;
        if($got_answer == true)
        {
            return view('student.survey.alrsubmit');
        }


//        $team = $speStudent->team;

        $teammates = $student->teams->first()->students;
        $teammates = $teammates->filter(function($value, $key) use ($student){
            return $value->id !== $student->id;
        }); // remove current student from teammates collection so there's no double counting

        return view('student.survey.show', compact('survey', 'student', 'teammates','speStudent'));
    }

    public function submit($uuid, Request $request){

        try{

            $answers = $request->get('answer');

            $speStudent = SpeStudent::where('uuid',$uuid)->firstOrFail();
            if (Carbon::create($speStudent->end_date)->lessThan(Carbon::now())) {
                return view('student.survey.expire');
            }
            $speStudent->completed = 1;
            $speStudent->save();
            $survey = $speStudent->speSurvey;

            $module_id = $survey->module_id;
            
            $question_count = $survey->spe_survey_questions()->where('question_type', 'scale')->count();
            $student = $speStudent->student;

            $team = $student->teams->where('module_id',$module_id)->first();
            $teammates_ids = $team->students->pluck('id');
            $teammates_count = $team->students->count();

            // save each survey response
         
            foreach($answers as $index => $answer){

                // map with question survey text in case of changes to the question in the future
                // single source of truth
                foreach($answer as $key => $item){
                    $question = SpeSurveyQuestion::find($key);
                    $survey_question = $question->survey_question;
                    $question_type = $question->question_type;
                    $answer['question_'.$key] = [
                        'question_id' => $key,
                        'question' => $survey_question,
                        'type' => $question_type,
                        'answer' => $item,
                    ];
                    unset($answer[$key]);
                    if ($question_type=='scale' && intval($item) <=2) {

                        $alert_cases = new AlertCase();
                        $alert_cases->score = $item;
                        $alert_cases->team_id = $team->id;
                        $alert_cases->student_id = $index;
                        $alert_cases->peer_id = $student->id;
                        $alert_cases->spe_survey_id = $survey->id;
                        $alert_cases->survey_question = $survey_question;
                        $alert_cases->answers = $item;
                        $alert_cases->question_number = $key;
                        $alert_cases->save();

                    }
                }
              
                // return only answers of question type scale and sum up the value
                $total_score = collect($answer)->filter(function ($value, $key) {
                    return $value['type'] == 'scale';
                })->sum('answer');
            
                $speAnswer = new speAnswer();
                $speAnswer->peer_id = $index; // student being peer reviewed
                $speAnswer->student_id = $student->id; // student doing the survey
                $speAnswer->team_id = $team->id;
                $speAnswer->spe_survey_id = $survey->id;
                $speAnswer->answers = json_encode($answer);
                $speAnswer->score_total = $total_score;
                $speAnswer->save();




//                $check_if_student_submitted = SpeScore::where('student_id', $student->id)->where('peer_id', $index)->where('team_id', $team->id)->where('spe_survey_id', $survey_id)->first();
//                if($check_if_student_submitted == null){
//                    $student_score = new SpeScore([
//                        'student_id' => $student->id, 'peer_id' => $index, 'team_id' => $team->id, 'spe_survey_id' => $survey->id, 'all_submitted' => 0, 'spe_total_scores' => $total_score
//                    ]);
//                    $student_score->save();
//                }

                $check_if_student_being_reviewed_has_final_score = SpeScore::where('student_id', $index)->where('team_id', $team->id)->where('spe_survey_id', $survey->id)->first();
                $submit_count = speAnswer::where('peer_id', $index)->where('team_id', $team->id)->count() == null ? 1 : speAnswer::where('peer_id', $index)->where('team_id', $team->id)->count();
                $final_score_avg = speAnswer::where('peer_id', $index)->where('team_id', $team->id)->sum('score_total') / $submit_count;
                $final_score_percentage = $final_score_avg / ($question_count * 5) * 100;
                if($check_if_student_being_reviewed_has_final_score == null){
                    $final_score = new SpeScore([
                        'student_id' => $index,     
                        'team_id' => $team->id,
                        'spe_survey_id' => $survey->id,
                        'spe_total_scores' => $final_score_percentage,
                        'submit_count' => $submit_count,
                        'all_submitted' => 0
                    ]);
                    $final_score->save();
                } else{
                    $final_score = SpeScore::where('student_id', $index)->where('team_id', $team->id)->update(['spe_total_scores' => $final_score_percentage]);
                }

//                $check_if_student_being_reviewed_has_final_score = SpeFinalScore::where('student_id', $index)->where('team_id', $team->id)->where('spe_survey_id', $survey_id)->first();
//                $submit_count = SpeScore::where('peer_id', $index)->where('team_id', $team->id)->count();
//                $final_score_avg = SpeScore::where('peer_id', $index)->where('team_id', $team->id)->sum('spe_total_scores') / $submit_count ;
//                if($check_if_student_being_reviewed_has_final_score == null){
//                    $final_score = new SpeFinalScore([
//                        'student_id' => $index, 'team_id' => $team->id, 'spe_survey_id' => $survey->id, 'final_score' => $final_score_avg, 'submit_count' => $submit_count
//                    ]);
//                    $final_score->save();
//                } else{
//                    $final_score = SpeFinalScore::where('student_id', $index)->where('team_id', $team->id)->update(['final_score' => $final_score_avg]);
//                }
            }

            // get number of students who has submitted the survey, and update all_submitted to 1 if everyone has submitted
            $submitted_surveys = speAnswer::whereIn('student_id', $teammates_ids)->pluck('student_id')->unique()->count();
            if($submitted_surveys == $teammates_count){
                SpeScore::where('team_id', $team->id)->update(['all_submitted' => 1]);
            } else {
                SpeScore::where('team_id', $team->id)->update(['submit_count' => $submitted_surveys]);
            }

            return view('student.survey.thankyou');

        } catch(\Exception $e){
            dd($e);
        }

    }


}
