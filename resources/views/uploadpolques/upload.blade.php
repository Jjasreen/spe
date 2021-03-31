@extends('layout')

@section('content')
{{Form::open(['method'=>'POST', 'files'=>true ])}}
{{Form::token()}}

<div>
    {{Form::label('Polling Name:', null, ['class'=>'form-label'])}}
    {{Form::text('polling_title', '' , ['class'=>'form-control'])}}
</div>


<div>
    {{Form::label('Polling Number:', null, ['class'=>'form-label'])}}
    {{Form::text('polling_number', '' , ['class'=>'form-control'])}}
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
    {{Form::label("polling_upload_date", null, ['class'=>'form-label'])}}
    {{Form::date('polling_upload_date', date('Y-m-d'), ['class'=>'form-control'])}}
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