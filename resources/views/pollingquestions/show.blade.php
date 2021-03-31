@extends('layout')

@section('content')
<h1>Polling {{$polling->id}}</h1>
<a href="/pollingquestions/{{$polling->id}}/create" class="btn btn-primary btn-sm">Add New Question</a> 
<br>
<br>
<table class="table">   
    <thead>
        <tr>            
            <th>Question Number</th>
            <th>Questions</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach($polling->polling_questions as $p)
        <tr>
            <td>{{$p->polling_question_number}}</td>
            <td>{{$p->polling_question}}</td>
            <td>{{$p->created_at}}</td>
            <td>{{$p->updated_at}}</td>
            
            <td>
                  
                <a href="/pollingquestions/{{$p->id}}/update" class="btn btn-primary btn-sm">Edit</a>
                <a href="/pollingquestions/{{$p->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection()