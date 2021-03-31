@extends('layout')

@section('content')
<h1>
    {{$disputecase->case_title}}
</h1>
<h2>
    {{$disputecase->module->module_name}}
</h2>
<div>   
    {{$disputecase->case_date}} <br>
    {{$disputecase->team->team_name}} <br>
    {{$disputecase->case_description}}
</div>



@endsection()