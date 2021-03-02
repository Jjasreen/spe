@extends('layout')

@section('content')
<h1>Survey#{{$spe_surveys->id}}</h1>

<div>
    <a href="/spe_surveys/{{$spe_surveys->id}}/students/update" class="btn btn-primary">
        Manage students
    </a>
</div>

<ul>
    <li>Survey Title: {{$spe_surveys->survey_title}}</li>
    <li>Teaching Period: {{$spe_surveys->teaching_period}}</li>
    <li>Unit Code: {{$spe_surveys->unit_code}}</li>
    <li>Module Name: {{$spe_surveys->module->module_name}}</li>
    
</ul>



@endsection()