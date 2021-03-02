@extends ('layout')

@section('content')
{{Form::open()}}
{{Form::token()}}
<div>
    {{Form::label('Unit Code', null, ['class'=>'form-label'])}}
    {{Form::text('unit_code', $team->unit_code, ['class'=>'form-control'])}}    
</div>

<div>
    {{Form::label('Teaching Period', null, ['class'=>'form-label'])}}
    {{Form::text('teaching_period', $team->teaching_period,['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Module", null, ['class'=>'form-label'])}}
    {{Form::select('module_id', $modules, $team->module_id,['class'=>'form-control'])}}
</div>

<div>
    {{Form::label('Students')}}
    {{Form::select('students[]', $students, $current_students,['multiple'=>true,'class'=>'form-control'])}}
</div>
{{Form::submit('Update', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}
@endsection