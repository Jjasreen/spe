@extends('layout')

@section('content')
<div class="alert alert-danger">
    {{Form::open()}}
    {{Form::token()}}
        Are you sure want to delete {{$uc->first_name}} {{$uc->last_name}}?
        {{Form::submit("Delete", ['class'=>'btn btn-danger'])}}
        <a href="/unit_coordinators" class="btn btn-success">Cancel delete</a>
    {{Form::close()}}
</div>


@endsection()
