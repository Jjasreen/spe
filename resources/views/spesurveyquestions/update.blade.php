@extends('layout')

@section('content')
<h1>Create SPE Survey Question for {{$question->survey_title}}</h1>
{{Form::open()}}
{{Form::token()}}


<div>
    {{Form::label("Question Number", null, ['class'=>'form-label'])}}
    {{Form::text('question_number',$question->question_number, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Question", null, ['class'=>'form-label'])}}
    {{Form::text('survey_question',$question->survey_question, ['class'=>'form-control'])}}
</div>

<br>

<div>
    {{Form::label("Survey Answer 1", null, ['class'=>'form-label'])}}
    {{Form::text('survey_answer_one', $question->survey_answer_one,['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Survey Answer 2", null, ['class'=>'form-label'])}}
    {{Form::text('survey_answer_two', $question->survey_answer_two,['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Survey Answer 3", null, ['class'=>'form-label'])}}
    {{Form::text('survey_answer_three', $question->survey_answer_three, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Survey Answer 4", null, ['class'=>'form-label'])}}
    {{Form::text('survey_answer_four',$question->survey_answer_four, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Survey Answer 5", null, ['class'=>'form-label'])}}
    {{Form::text('survey_answer_five', $question->survey_answer_five, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Question Comments", null, ['class'=>'form-label'])}}
    {{Form::text('question_comments', $question->question_comments, ['class'=>'form-control'])}}
</div>

{{Form::submit('Update', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}

@endsection()