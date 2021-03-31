@extends('layout')

@section('content')
<h1>Polling#{{$polling->id}}</h1>

<div>
    <a href="/polling/{{$polling->id}}/students/update" class="btn btn-primary">
        Manage students
    </a>
</div>

<ul>
    <li>Polling Title: {{$polling->polling_title}}</li>
    <li>Teaching Period: {{$polling->teaching_period}}</li>
    <li>Unit Code: {{$polling->unit_code}}</li>
    <li>Module Name: {{$polling->module->module_name}}</li>
    
</ul>



@endsection()