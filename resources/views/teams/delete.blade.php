@extends('layout')

@section('content')
<div class="alert alert-danger">
    {{Form::open()}}
    {{Form::token()}}
        Are you sure want to delete {{$team->team_name}}?
        {{Form::submit("Delete", ['class'=>'btn btn-danger'])}}
        <a href="/teams" class="btn btn-success">Cancel delete</a>
    {{Form::close()}}
</div>

@endsection()