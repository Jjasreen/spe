@extends('layout')

@section('content')

<div class="container">
<div class ="card">
 
            <h2 class="card-title ml-3">Student List</h2>
            <div class = "card-body">
            <p>Please note that only the following file formats CSV/XLSX are supported to import students details:</p>


{{Form::open(['method'=>'POST', 'files'=>true ])}}
{{Form::token()}}

<div>
    {{Form::label('Select file to upload:', null, ['class'=>'form-label'])}}
    {{Form::file('upload', ['class'=>'form-control'])}}
</div>

{{Form::submit('Upload', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}
</div>
</div>
</div>
@endsection()