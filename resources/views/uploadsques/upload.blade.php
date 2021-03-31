@extends('layout')

@section('content')
{{Form::open(['method'=>'POST', 'files'=>true ])}}
{{Form::token()}}

<div>
    {{Form::label('Survey Name:', null, ['class'=>'form-label'])}}
    {{Form::text('survey_title', '' , ['class'=>'form-control'])}}
</div>


<div>
    {{Form::label('Survey Number:', null, ['class'=>'form-label'])}}
    {{Form::text('spe_survey_number', '' , ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label('Survey Description:', null, ['class'=>'form-label'])}}
    {{Form::text('survey_description', '' , ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label('Unit Code:', null, ['class'=>'form-label'])}}
    {{Form::text('unit_code', '' , ['class'=>'form-control'])}}
</div>


<div>
    {{Form::label('Teaching Period:', null, ['class'=>'form-label'])}}
    {{Form::text('teaching_period','', ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("survey_upload_date", null, ['class'=>'form-label'])}}
    {{Form::date('survey_upload_date', date('Y-m-d'), ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Module", null, ['class'=>'form-label'])}}
    {{Form::select('module_id',$mn, null, ['class'=>'form-control'])}}
</div>


<div>
    {{Form::label('Select file to upload:', null, ['class'=>'form-label'])}}
    {{Form::file('upload', ['class'=>'form-control'])}}
</div>

{{Form::submit('Upload', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}
@endsection()