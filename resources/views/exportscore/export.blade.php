@extends('layout')


    
@section('content')
{{Form::open()}}

<div class="container">

<div class = "card">
<div>
    <h2 class = "card-title ml-3">Export Survey Student Scores</h2>
    <div class = "card-body">
    {{Form::label("Survey", null, ['class'=>'form-label'])}}
    {{Form::select('survey_id',$surveys, null, ['class'=>'form-control'])}}
</div>

{{Form::submit('Export')}}

@csrf


{{Form::close()}}
</div>
</div>
</div>
@endsection