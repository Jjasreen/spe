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


{{Form::submit('Update', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}

@endsection()