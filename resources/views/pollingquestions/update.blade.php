@extends('layout')

@section('content')
<h1>Create Polling Question for {{$question->polling_title}}</h1>
{{Form::open()}}
{{Form::token()}}


<div>
    {{Form::label("Question Number", null, ['class'=>'form-label'])}}
    {{Form::text('polling_question_number',$question->polling_question_number, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Question", null, ['class'=>'form-label'])}}
    {{Form::text('polling_question',$question->polling_question, ['class'=>'form-control'])}}
</div>

<br>



{{Form::submit('Update', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}

@endsection()