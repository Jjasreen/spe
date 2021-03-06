@extends('layout')

@section('content')
<h1>Create Coordinator List</h1>

{{Form::open()}}
{{Form::token()}}
<div>
    {{Form::label("First Name", null, ['class'=>'form-label'])}}
    {{Form::text('first_name', '', ['class'=>'form-control'])}}
</div>
<div>
    {{Form::label("Last Name", null, ['class'=>'form-label'])}}
    {{Form::text('last_name', '', ['class'=>'form-control'])}}
</div>
<div>
    {{Form::label("Unit Code", null, ['class'=>'form-label'])}}
    {{Form::text('unit_code', '', ['class'=>'form-control'])}}
</div>
<div>
    {{Form::label("Teaching Period", null, ['class'=>'form-label'])}}
    {{Form::text('teaching_period', '', ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Email Address", null, ['class'=>'form-label'])}}
    {{Form::text('email_address', '', ['class'=>'form-control'])}}
</div>

<div class="form-group">
    <label>Password:</label>
    <input type="password" id="password" name="password" class="form-control" data-toggle="password">
</div>


{{Form::submit('Create', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}



@endsection()