@extends('layout')

@section('content')
    <h1 class="mt-14">Send Dispute Case for {{$module->module_name}}</h1>


    <h3 class="font-bold pb-2 text-center">Students</h3>
    {{ Form::open(['route' => ['send_dispute_case_email_to_students', $module_id], 'method' => 'POST']) }}

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

    {{ Form::submit('Send Emails to Selected Students', ['class' => 'mt-3 btn btn-primary']) }}
    {{ Form::close() }}


@endsection()
