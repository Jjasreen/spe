@extends('layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

 
            <h2 class="font-bold text-center">Student List</h2>
            <p class="mt-1 text-md text-gray-700 text-center">Please note that only the following file formats CSV/XLSX are supported to import students details:</p>


{{Form::open(['method'=>'POST', 'files'=>true ])}}
{{Form::token()}}

<div>
    {{Form::label('Select file to upload:', null, ['class'=>'form-label'])}}
    {{Form::file('upload', ['class'=>'form-control'])}}
</div>

{{Form::submit('Upload', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}
@endsection()