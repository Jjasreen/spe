@extends('layout')

@section('content')
<h1>Team#{{$team->id}}</h1>

<ul>
    <li>Teaching Period: {{$team->teaching_period}}</li>
    <li>Unit Code: {{$team->unit_code}}</li>
    <li>Module: {{$team->module->module_name}}</li>
    <li>Unit Coordinator: {{$team->module->unit_coordinator->first_name}}  {{$team->module->unit_coordinator->last_name}}
</ul>

<h2>Team Members</h2>
<ul class="list-group">
    @foreach($team->students as $student)
    <li class="list-group-item">{{$student->s_givenname}}</li>    
    @endforeach()
  </ul>

@endsection()