@extends('layout')

@section('content')
<div class="alert alert-danger">
    {{Form::open()}}
    {{Form::token()}}
        Are you sure want to delete {{$polling->polling_title}}?
        {{Form::submit("Delete", ['class'=>'btn btn-danger'])}}
        <a href="/polling" class="btn btn-success">Cancel delete</a>
    {{Form::close()}}
</div>

@endsection()