@extends('layout')

@section('content')
<h1>Create Admin List</h1>

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
    {{Form::label("Email Address", null, ['class'=>'form-label'])}}
    {{Form::text('email_address', '', ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Password", null, ['class'=>'form-label'])}}
    {{Form::text('password', '', ['class'=>'form-control'])}}
</div>


{{Form::submit('Create', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}



@endsection()