@extends('layout')

@section('content')
<div class="alert alert-danger">
    {{Form::open()}}
    {{Form::token()}}
        Are you sure want to delete {{$question->survey_question}}?
        {{Form::submit("Delete", ['class'=>'btn btn-danger'])}}
        <a href="/questions/{speSurvey}/show'" class="btn btn-success">Cancel delete</a>
    {{Form::close()}}
</div>

@endsection()