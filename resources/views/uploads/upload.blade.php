@extends('layout')

@section('content')
{{Form::open(['method'=>'POST', 'files'=>true ])}}
{{Form::token()}}

<div>
    {{Form::label('Select file to upload:', null, ['class'=>'form-label'])}}
    {{Form::file('upload', ['class'=>'form-control'])}}
</div>

{{Form::submit('Upload', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}
@endsection()