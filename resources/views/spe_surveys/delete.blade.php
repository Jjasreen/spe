@extends('layout')

@section('content')
<div class="alert alert-danger">
    {{Form::open()}}
    {{Form::token()}}
        Are you sure want to delete {{$spe_surveys->survey_title}}?
        {{Form::submit("Delete", ['class'=>'btn btn-danger'])}}
        <a href="/spe_surveys" class="btn btn-success">Cancel delete</a>
    {{Form::close()}}
</div>

@endsection()