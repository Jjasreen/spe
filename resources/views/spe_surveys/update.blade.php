@extends ('layout')

@section('content')
{{Form::open()}}
{{Form::token()}}
<div>
    {{Form::label("Survey Title", null, ['class'=>'form-label'])}}
    {{Form::text('survey_title',$surveys->survey_title, ['class'=>'form-control'])}}
</div>
<br>
<div>
    {{Form::label("Survey Description", null, ['class'=>'form-label'])}}
    {{Form::text('survey_description',$surveys->survey_description, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Survey Number", null, ['class'=>'form-label'])}}
    {{Form::text('spe_survey_number',$surveys->spe_survey_number, ['class'=>'form-control'])}}
</div>


<div>
    {{Form::label("Unit Code", null, ['class'=>'form-label'])}}
    {{Form::select('unit_code',$unit_code, $surveys->unit_code, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Unit Coordinator ID", null, ['class'=>'form-label'])}}
    {{Form::select('unit_coordinator_id',$uc, null, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Teaching Period", null, ['class'=>'form-label'])}}
    {{Form::select('teaching_period', $tp, $surveys->teaching_period, ['class'=>'form-control'])}}
</div>

<br>

<div>
    {{Form::label("survey_upload_date", null, ['class'=>'form-label'])}}
    {{Form::date('survey_upload_date', date('Y-m-d', strtotime($surveys->survey_upload_date)), ['class'=>'form-control'])}}
</div>

<br>

<div>
    {{Form::label("Module Name", null, ['class'=>'form-label'])}}
    {{Form::select('module_id',$mn, null, ['class'=>'form-control'])}}
</div>

{{Form::submit('Update', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}
@endsection