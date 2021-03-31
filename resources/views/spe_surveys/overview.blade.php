@extends('layout')

@section('content')
    <h1 class="mt-14">Overview: Survey#{{ $speSurvey->id }}</h1>

    <div>
        <a href="/spe_surveys/{{ $speSurvey->id}}/manage" class="btn btn-primary m-3">
            Manage
        </a>
    </div>

    <div class="p-3 flex flex-row space-x-16 mb-4">
        <p>Survey Title: {{$speSurvey->survey_title}}</p>
        <p>Teaching Period: {{$speSurvey->teaching_period}}</p>
        <p>Unit Code: {{$speSurvey->unit_code}}</p>
        <p>Module Name: {{$speSurvey->module->module_name}}</p>
    </div>

    <h3 class="font-bold pb-2 text-center">Sent Surveys</h3>
    <table class="table">
        <thead>
        <tr>
            <th>Survey ID</th>
            <th>Student</th>
            <th>Student Email</th>
            <th>Completed</th>
            <th>Actions</th>

        </tr>
        </thead>
        <tbody>
        {{--        @foreach($student_surveys as $s)--}}
        {{--            <tr>--}}
        {{--                <td>--}}

        {{--                </td>--}}
        {{--            </tr>--}}
        {{--        @endforeach--}}
        </tbody>
    </table>


@endsection()
