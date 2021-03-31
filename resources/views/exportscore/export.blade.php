@extends('layout')


    
@section('content')
{{Form::open()}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
 

<div>
    {{Form::label("Survey", null, ['class'=>'form-label'])}}
    {{Form::select('survey_id',$surveys, null, ['class'=>'form-control'])}}
</div>

{{Form::submit('Export')}}

@csrf


{{Form::close()}}
@endsection