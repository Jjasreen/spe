@extends('layout')

@section('content')
<h1>SPE Survey List</h1>
<a href="/upload_question" class="btn btn-secondary btn-sm">Upload Survey Questions</a>
<table class="table">   
    <thead>
        <tr>            
            <th>Survey ID</th>
            <th>Survey Number</th>
            <th>Survey Title</th>
            <th>Unit Code</th>
            <th>Teaching Period</th>
            <th>Survey Upload Date</th>
            <th>Module ID</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach($spe_surveys as $s)
        <tr>
            <td>{{$s->id}}</td>
            <td>{{$s->spe_survey_number}}</td>
            <td>{{$s->survey_title}}</td>
            <td>{{$s->unit_code}}</td>
            <td>{{$s->teaching_period}}</td>
            <td>{{$s->survey_upload_date}}</td>
            <td>{{$s->Module->module_name}}</td>
            <td>
                <a href="/spe_surveys/{{$s->id}}/details" class="btn btn-secondary btn-sm">View</a>
                <a href="/spe_surveys/{{$s->id}}/update" class="btn btn-primary btn-sm">Edit</a>
                <a href="/spe_surveys/{{$s->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
                <a href="/questions/{{$s->id}}/show" class="btn btn-primary btn-sm">View Questions</a>
                <a href="/spe_surveys/{{$s->id}}/manage" class="btn btn-primary btn-sm">Manage Students</a>
                {{-- <a href="/exportscore/{{$s->id}}" class="btn btn-primary btn-sm">Export Score</a> --}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection()