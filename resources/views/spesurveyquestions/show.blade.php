@extends('layout')

@section('content')
<h1>SPE Survey {{$speSurvey->id}}</h1>
<a href="/questions/{{$speSurvey->id}}/create" class="btn btn-primary btn-sm">Add New Question</a> 
<br>
<br>
<table class="table">   
    <thead>
        <tr>            
            <th>Question Number</th>
            <th>Questions</th>
            <th>Answers 1</th>
            <th>Answers 2</th>
            <th>Answers 3</th>
            <th>Answers 4</th>
            <th>Answers 5</th>
            <th>Question Comments</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach($speSurvey->spe_survey_questions as $s)
        <tr>
            <td>{{$s->question_number}}</td>
            <td>{{$s->survey_question}}</td>
            <td>{{$s->survey_answer_one}}</td>
            <td>{{$s->survey_answer_two}}</td>
            <td>{{$s->survey_answer_three}}</td>
            <td>{{$s->survey_answer_four}}</td>
            <td>{{$s->survey_answer_five}}</td>
            <td>{{$s->question_comments}}</td>
            <td>{{$s->created_at}}</td>
            <td>{{$s->updated_at}}</td>
            
            <td>
                  
                <a href="/questions/{{$s->id}}/update" class="btn btn-primary btn-sm">Edit</a>
                <a href="/questions/{{$s->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection()