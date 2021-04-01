@extends('layout')

@section('content')
<h1>Update Admin Details List</h1>

{{Form::open()}}
{{Form::token()}}
<div>
    {{Form::label("Name", null, ['class'=>'form-label'])}}
    {{Form::text('name', $ad->name, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Email Address", null, ['class'=>'form-label'])}}
    {{Form::text('email', $ad->email, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Password", null, ['class'=>'form-label'])}}
    {{Form::text('password', '', ['class'=>'form-control'])}}
</div>

{{Form::submit('Update', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}



@endsection()