@extends('seclayout')

@section('content')
{{Form::open(['method'=>'POST', 'files'=>true ])}}
{{Form::token()}}

<div>
    {{Form::label('Submission title:', null, ['class'=>'form-label'])}}
    {{Form::text('submission_title', '', ['class'=>'form-control'])}}
</div>


<div>
    {{Form::label('Select file to upload:', null, ['class'=>'form-label'])}}
    {{Form::file('upload', ['class'=>'form-control'])}}
</div>

{{Form::submit('Upload', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}
@endsection()