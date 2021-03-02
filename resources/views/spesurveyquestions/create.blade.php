@extends('layout')

@section('content')
<h1>Create SPE Survey Question for {{$survey->survey_title}}</h1>
{{Form::open()}}
{{Form::token()}}


<div>
    {{Form::label("Question Number", null, ['class'=>'form-label'])}}
    {{Form::text('question_number','', ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Question", null, ['class'=>'form-label'])}}
    {{Form::text('survey_question','', ['class'=>'form-control'])}}
</div>

<br>

<div>
    {{Form::label("Survey Answer 1", null, ['class'=>'form-label'])}}
    {{Form::text('survey_answer_one', '', null, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Survey Answer 2", null, ['class'=>'form-label'])}}
    {{Form::text('survey_answer_two', '', null, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Survey Answer 3", null, ['class'=>'form-label'])}}
    {{Form::text('survey_answer_three', '', null, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Survey Answer 4", null, ['class'=>'form-label'])}}
    {{Form::text('survey_answer_four', '', null, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Survey Answer 5", null, ['class'=>'form-label'])}}
    {{Form::text('survey_answer_five', '', null, ['class'=>'form-control'])}}
</div>

{{Form::submit('Create', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}

@endsection()