@extends('layout')

@section('content')
    <h1 class="mt-14">Manage: Deliverable for Module#{{ $module->id }}</h1>

    <div>
        <a href="/deliverablesubmission/{{ $module->id}}/overview" class="btn btn-primary m-3">
             Back to Overview
        </a>
    </div>

    <div class="p-3 flex flex-row space-x-16 mb-4">
        <p>Module Name: {{$module->module_name}}</p>
        <p>Teaching Period: {{$module->unit_coordinator->teaching_period}}</p>
        <p>Unit Code: {{$module->unit_code}}</p>
    </div>

    <h3 class="font-bold pb-2 text-center">Students</h3>
    {{ Form::open(['route' => ['send_submission_email_to_students', $module->id], 'method' => 'POST']) }}

    {{Form::label("Select students", null, ['class'=>'form-label'])}}
{{--    {{Form::select('students[]', $students,--}}
{{--              $students, ['multiple'=>true, 'class'=>'form-control'])}}--}}

    <select name="students[]" class="form-multiselect block w-full mt-1" multiple>
        @foreach($secretaries as $student)
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

    {{ Form::submit('Send Emails to Selected Students', ['class' => 'my-3 inline-flex items-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm']) }}
    {{ Form::close() }}


@endsection()
