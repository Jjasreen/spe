@extends('layout')

@section('content')
<h1>Create Module List</h1>
{{Form::open()}}
{{Form::token()}}


<div>
    {{Form::label("Unit Code", null, ['class'=>'form-label'])}}
    {{Form::text('unit_code', '', ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Module Name", null, ['class'=>'form-label'])}}
    {{Form::text('module_name', '', ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Unit Coordinator", null, ['class'=>'form-label'])}}
    {{Form::select(' unit_coordinator_id', $all_uc, null, ['class'=>'form-control'])}}
</div>

{{Form::submit('Create', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}

@endsection()