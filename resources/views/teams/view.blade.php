@extends('layout')

@section('content')
<h1>Team List</h1>
<table class="table">   
    <thead>
        <tr>            
            <th>Team ID</th>
            <th>Team Name</th>
            <th>Unit Code</th>
            <th>Teaching Period</th>
            <th>Module Name</th>
            <th>Module ID</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach($teams as $t)
        <tr>
            <td>{{$t->id}}</td>
            <td>{{$t->team_name}}</td>
            <td>{{$t->unit_code}}</td>
            <td>{{$t->teaching_period}}</td>
            <td>{{$t->module->module_name}}</td>
            <td>{{$t->module_id}}</td>
            <td>
                <a href="/teams/{{$t->id}}/details" class="btn btn-secondary btn-sm">View</a>
                <a href="/teams/{{$t->id}}/update" class="btn btn-primary btn-sm">Edit</a>
                <a href="/teams/{{$t->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection()