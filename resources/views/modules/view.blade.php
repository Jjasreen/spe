@extends('layout')

@section('content')
<h1>Manage Modules</h1>
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
                <a href="/modules/{{$m->id}}/dashboard" class="btn btn-primary btn-sm">Dashboard</a>
                <a href="{{route('manage_module_deliverable',['module'=>$m->id])}}" class="btn btn-primary btn-sm">Request Submission</a>
                <a href="/spe_surveys?module_id={{$m->id}}" class="btn btn-primary btn-sm">Manage Survey</a>
                <a href="/polling/{{$m->id}}" class="btn btn-primary btn-sm">Manage Poll</a>
                <a href="/teams/{{$m->id}}" class="btn btn-primary btn-sm">Manage Teams</a>
                <a href="/disputecase/{{$m->id}}/manage" class="btn btn-primary btn-sm">Manage Dispute Case</a>
                
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection()