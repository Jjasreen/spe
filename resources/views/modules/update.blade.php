@extends('layout')

@section('content')
<h1>Update Module List</h1>

{{Form::open()}}
{{Form::token()}}
<div>
    {{Form::label("Unit Code", null, ['class'=>'form-label'])}}
    {{Form::text('unit_code', $m->unit_code, ['class'=>'form-control'])}}
</div>
<div>
    {{Form::label("Module name", null, ['class'=>'form-label'])}}
    {{Form::text('module_name', $m->module_name, ['class'=>'form-control'])}}
</div>
<div>
    {{Form::label("Unit Coordinator", null, ['class'=>'form-label'])}}
    {{Form::text('unit_coordinator_id',$m->unit_coordinator_id, ['class'=>'form-control'])}}
</div>

{{Form::submit('Update', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}


@endsection()





