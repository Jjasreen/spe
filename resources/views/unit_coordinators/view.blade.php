@extends('layout')

@section('content')
<h1>Unit Coordinator List</h1>
<a href="/unit_coordinators/create" class="btn btn-secondary btn-sm">Add Unit Coordinator</a>
<br>
<br>
<table class="table">   
    <thead>
        <tr>            
            <th>First Name</th>
            <th>Last Name</th>
            <th>Unit Code</th>
            <th>Teaching Period</th>
            <th>Action</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($unit_coordinators as $uc)
        <tr>
            <td>{{$uc->first_name}}</td>
            <td>{{$uc->last_name}}</td>
            <td>{{$uc->unit_code}}</td>
            <td>{{$uc->teaching_period}}</td>
            <td>
                <a href="/unit_coordinators/{{$uc->id}}/update" class="btn btn-primary btn-sm">Edit</a>
                <a href="/unit_coordinators/{{$uc->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection()