@extends('layout')

@section('content')
<h1>Unit Coordinator List</h1>
<table class="table">   
    <thead>
        <tr>            
            <th>Unit Code</th>
            <th>Module Name</th>
            <th>Unit Coordinator</th>
        </tr>
    </thead>
    <tbody>
        @foreach($modules as $m)
        <tr>
            <td>{{$m->unit_code}}</td>
            <td>{{$m->module_name}}</td>
            <td>{{$m->unit_coordinator->first_name}} {{$m->unit_coordinator->last_name}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection()