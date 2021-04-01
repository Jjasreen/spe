@extends('layout')

@section('content')
    <h1 class="mt-14">Manage: Polling#{{ $spePolling->id }}</h1>

    <div>
        <a href="/polling/{{ $spePolling->id}}/overview" class="btn btn-primary m-3">
             Back to Overview
        </a>
    </div>

    <div class="p-3 flex flex-row space-x-16 mb-4">
        <p>Polling Title: {{$spePolling->polling_title}}</p>
        <p>Teaching Period: {{$spePolling->teaching_period}}</p>
        <p>Unit Code: {{$spePolling->unit_code}}</p>
        <p>Module Name: {{$spePolling->module->module_name}}</p>
    </div>
    <div>
    <h3 class="font-bold pb-2 text-center">Students</h3>
    {{ Form::open(['route' => ['send_polling_email_to_students', $spePolling->id], 'method' => 'POST']) }}

    {{Form::label("Select students", null, ['class'=>'form-label'])}}
{{--    {{Form::select('students[]', $students,--}}
{{--              $students, ['multiple'=>true, 'class'=>'form-control'])}}--}}

    <select name="students[]" class="form-multiselect form-control" multiple>
        @foreach($students as $student)
            <option value="{{ $student->id }}">{{ $student->s_title.' '.$student->s_givenname.' - '.$student->s_email  }}</option>
        @endforeach
    </select>


{{--    <table class="table">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th></th>--}}
{{--            <th>Student</th>--}}
{{--            <th>Student Email</th>--}}

{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--            @foreach($students as $student)--}}
{{--                <tr>--}}
{{--                    <td></td>--}}
{{--                    <td>{{ $student->s_title.' '.$student->s_givenname }}</td>--}}
{{--                    <td>{{ $student->s_email }}</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}

    {{ Form::submit('Send Emails to Selected Students', ['class' => '']) }}
    {{ Form::close() }}

</div>
@endsection()
