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

<div>
    {{Form::label("Question Type", null, ['class'=>'form-label'])}}
    {{Form::select('question_type', $question_types, null, ['class'=>'form-control'])}}
</div>

{{-- <div>
    {{Form::label("Survey Answer 1", null, ['class'=>'form-label'])}}
    {{Form::text('survey_answer_1', '', ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Survey Answer 2", null, ['class'=>'form-label'])}}
    {{Form::text('survey_answer_2', '', ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Survey Answer 3", null, ['class'=>'form-label'])}}
    {{Form::text('survey_answer_3', '', ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Survey Answer 4", null, ['class'=>'form-label'])}}
    {{Form::text('survey_answer_4', '', ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Survey Answer 5", null, ['class'=>'form-label'])}}
    {{Form::text('survey_answer_5', '',  ['class'=>'form-control'])}}
</div> --}}

{{-- <div>
    {{Form::label("question comments", null, ['class'=>'form-label'])}}
    {{Form::text('question_comments', '', ['class'=>'form-control'])}}
</div> --}}

{{Form::submit('Create', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}

@endsection()