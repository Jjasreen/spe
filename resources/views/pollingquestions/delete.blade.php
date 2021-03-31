@extends('layout')

@section('content')
<div class="alert alert-danger">
    {{Form::open()}}
    {{Form::token()}}
        Are you sure want to delete {{$question->polling_question}}?
        {{Form::submit("Delete", ['class'=>'btn btn-danger'])}}
        <a href="/pollingquestions/{polling}/show'" class="btn btn-success">Cancel delete</a>
    {{Form::close()}}
</div>

@endsection()