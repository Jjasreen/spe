@extends('layout')

@section('content')
<h1>Create SPE Survey List</h1>
{{Form::open()}}
{{Form::token()}}


<div>
    {{Form::label("Survey Title", null, ['class'=>'form-label'])}}
    {{Form::text('survey_title','', null, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Survey Description", null, ['class'=>'form-label'])}}
    {{Form::text('survey_description','', null, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Survey Number", null, ['class'=>'form-label'])}}
    {{Form::text('spe_survey_number','', ['class'=>'form-control'])}}
</div>

<br>

<div>
    {{Form::label("Unit Code", null, ['class'=>'form-label'])}}
    {{Form::select('unit_code',$surveys, null, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Unit Coordinator ID", null, ['class'=>'form-label'])}}
    {{Form::select('unit_coordinator_id',$uc, null, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Teaching Period", null, ['class'=>'form-label'])}}
    {{Form::select('teaching_period', $tp, null, ['class'=>'form-control'])}}
</div>

<br>

<div>
    {{Form::label("survey_upload_date", null, ['class'=>'form-label'])}}
    {{Form::date('survey_upload_date', date('Y-m-d'), null, ['class'=>'form-control'])}}
</div>

<br>

<div>
    {{Form::label("Module Name", null, ['class'=>'form-label'])}}
    {{Form::select('module_id',$mn, null, ['class'=>'form-control'])}}
</div>


{{Form::submit('Create', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}

@endsection()