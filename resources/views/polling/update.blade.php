@extends ('layout')

@section('content')
{{Form::open()}}
{{Form::token()}}
<div>
    {{Form::label("Polling Title", null, ['class'=>'form-label'])}}
    {{Form::text('polling_title',$polling->polling_title, ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Polling Number", null, ['class'=>'form-label'])}}
    {{Form::text('polling_number',$polling->polling_number, ['class'=>'form-control'])}}
</div>

<br>

{{-- <div>
    {{Form::label("Unit Code", null, ['class'=>'form-label'])}}
    {{Form::select('unit_code',$p_unit_code, $polling->unit_code, ['class'=>'form-control'])}}
</div> --}}



<div>
    {{Form::label("Teaching Period", null, ['class'=>'form-label'])}}
    {{Form::select('teaching_period', $tp, $polling->teaching_period, ['class'=>'form-control'])}}
</div>

<br>

<div>
    {{Form::label("polling_uploaded_date", null, ['class'=>'form-label'])}}
    {{Form::date('polling_upload_date', date('Y-m-d', strtotime($polling->polling_upload_date)), ['class'=>'form-control'])}}
</div>

<div>
    {{Form::label("Module Name", null, ['class'=>'form-label'])}}
    {{Form::select('module_id',$mn, null, ['class'=>'form-control'])}}
</div>


{{Form::submit('Update', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}
@endsection