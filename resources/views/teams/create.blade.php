@extends('layout')

@section('content')
<h1>Create Team List</h1>
{{Form::open()}}
{{Form::token()}}


<div>
    {{Form::label("Unit Code", null, ['class'=>'form-label'])}}
    {{Form::select('unit_code',$mods, null, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Teaching Period", null, ['class'=>'form-label'])}}
    {{Form::select('teaching_period', $studs, null, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Module name", null, ['class'=>'form-label'])}}
    {{Form::select('module_id',$modules, null, ['class'=>'form-control'])}}
</div>
<br>
<div>
    {{Form::label("Team Name", null, ['class'=>'form-label'])}}
    {{Form::text('team_name','', null, ['class'=>'form-control'])}}
</div>

{{Form::submit('Create', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}

@endsection()