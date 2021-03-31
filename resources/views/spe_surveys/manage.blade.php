@extends('layout')

@section('content')
    <h1 class="mt-14">Manage: Survey#{{ $speSurvey->id }}</h1>

    <div>
        <a href="/spe_surveys/{{ $speSurvey->id}}/overview" class="btn btn-primary m-3">
             Back to Overview
        </a>
    </div>

    <div class="p-3 flex flex-row space-x-16 mb-4">
        <p>Survey Title: {{$speSurvey->survey_title}}</p>
        <p>Teaching Period: {{$speSurvey->teaching_period}}</p>
        <p>Unit Code: {{$speSurvey->unit_code}}</p>
        <p>Module Name: {{$speSurvey->module->module_name}}</p>
    </div>

    <h3 class="font-bold pb-2 text-center">Students</h3>
    {{ Form::open(['route' => ['send_survey_email_to_students', $speSurvey->id], 'method' => 'POST']) }}
    <div>
   
        {{Form::label("Select students", null, ['class'=>'form-label'])}}
  

         <select name="students[]" class="form-control" multiple style="background-color:black">
            @foreach($students as $student)
                <option value="{{ $student->id }}">{{ $student->s_title.' '.$student->s_givenname.' - '.$student->s_email  }}</option>
            @endforeach
        </select> 
    </div>


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
