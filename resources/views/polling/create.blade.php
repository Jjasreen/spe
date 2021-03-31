@extends('layout')

@section('content')
<h1>Create Polling List</h1>
{{Form::open()}}
{{Form::token()}}


<div>
    {{Form::label("Polling Title", null, ['class'=>'form-label'])}}
    {{Form::text('polling_title','', ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Polling Number", null, ['class'=>'form-label'])}}
    {{Form::text('polling_number','', ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Unit Code", null, ['class'=>'form-label'])}}
    {{Form::select('unit_code',$p_unit_code, null, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Unit Coordinator ID", null, ['class'=>'form-label'])}}
    {{Form::select('unit_coordinator_id',$uc_id, null, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Teaching Period", null, ['class'=>'form-label'])}}
    {{Form::select('teaching_period', $tp, null, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("polling_uploaded_at", null, ['class'=>'form-label'])}}
    {{Form::date('polling_upload_date', date('Y-m-d'), ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Module Name", null, ['class'=>'form-label'])}}
    {{Form::select('module_id',$mn, null, ['class'=>'form-control'])}}
</div>

{{Form::submit('Create', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}

@endsection()