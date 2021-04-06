@extends('layout')

@section('content')
<h1>Polling List</h1>
<a href="/upload_polquestion" class="btn btn-secondary btn-sm">Upload Polling Questions</a>
<table class="table">   
    <thead>
        <tr>            
            <th>Polling ID</th>
            <th>Polling Number</th>
            <th>Polling Title</th>
            <th>Unit Code</th>
            <th>Teaching Period</th>
            <th>Polling Upload Date</th>
            <th>Unit Cordinator ID</th>
            <th>Module ID</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach($polling as $p)
        <tr>
            <td>{{$p->id}}</td>
            <td>{{$p->polling_number}}</td>
            <td>{{$p->polling_title}}</td>
            <td>{{$p->unit_code}}</td>
            <td>{{$p->teaching_period}}</td>
            <td>{{$p->polling_upload_date}}</td>
            <td>{{$p->unit_coordinator_id}}</td>
            <td>{{$p->Module->module_name}}</td>
            <td>
                <a href="/polling/{{$p->id}}/details" class="btn btn-secondary btn-sm">View</a>
                <a href="/polling/{{$p->id}}/update" class="btn btn-primary btn-sm">Edit</a>
                <a href="/polling/{{$p->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
                <a href="/pollingquestions/{{$p->id}}/show" class="btn btn-primary btn-sm">View Questions</a>
                <a href="/polling/{{$p->id}}/manage" class="btn btn-primary btn-sm">Manage Students</a>
                <a href="/polling/{{$p->id}}/results" class="btn btn-primary btn-sm">View Poll Results</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection()