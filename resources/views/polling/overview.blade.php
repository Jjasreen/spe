@extends('layout')

@section('content')
    <h1 class="mt-14">Overview: Polling#{{$spePolling->id }}</h1>

    <div>
        <a href="/polling/{{$spePolling->id}}/manage" class="btn btn-primary m-3">
            Manage
        </a>
    </div>

    <div class="p-3 flex flex-row space-x-16 mb-4">
        <p>Polling Title: {{$spePolling->polling_title}}</p>
        <p>Teaching Period: {{$spePolling->teaching_period}}</p>
        <p>Unit Code: {{$spePolling->unit_code}}</p>
    </div>

    <h3 class="font-bold pb-2 text-center">Sent Polling</h3>
    <table class="table">
        <thead>
        <tr>
            <th>Polling ID</th>
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
