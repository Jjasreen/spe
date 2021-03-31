@extends('layout')

@section('content')
{{Form::open()}}
{{Form::token()}}



<div>
{{Form::label("Select students", null, ['class'=>'form-label'])}}
{{Form::select('students[]', $students, 
          $current_students, ['multiple'=>true, 'class'=>'form-control'])}}
</div>

{{Form::submit('Update', ['class'=>'btn btn-primary'])}}

{{ Form::close()}}

@endsection()