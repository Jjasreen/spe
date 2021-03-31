@extends('layout')

@section('content')


<h1>Manage Modules</h1>

<a href="/modules/create" class="btn btn-primary btn-sm">Create Module</a>
<table class="table">   
    <thead>
        <tr>            
            <th>Unit Code</th>
            <th>Module Name</th>
            <th>Unit Coordinator</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($modules as $m)
        <tr>
            <td>{{$m->unit_code}}</td>
            <td>{{$m->module_name}}</td>
            <td>{{$m->unit_coordinator->first_name}} {{$m->unit_coordinator->last_name}}</td>
            <td>
            <a href="/modules/{{$m->id}}/update" class="btn btn-primary btn-sm">Update Module</a>
            <a href="/modules/{{$m->id}}/delete" class="btn btn-primary btn-sm">Delete Module</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection()