@extends('seclayout')

@section('content')
{{Form::open(['method'=>'POST', 'files'=>true ])}}
{{Form::token()}}

<div>
    {{Form::label('Submission title:', null, ['class'=>'form-label'])}}
    {{Form::text('submission_title', '', ['class'=>'form-control'])}}
</div>


<div>
    {{Form::label('Select Weeky Status Report:', null, ['class'=>'form-label'])}}
    {{Form::file('upload', ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label('Select Deliverable Task Breakdown:', null, ['class'=>'form-label'])}}
    {{Form::file('upload2', ['class'=>'form-control'])}}
</div>

{{Form::submit('Upload', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}
@endsection()