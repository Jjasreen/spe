@extends('layout')


@section('content')
<h1>Poll Results for {{$polling->polling_title}}</h1>

<table class="table">
    <thead>
        <tr>
            <th>Question</th>
            <th>Yes</th>
            <th>No</th>
        </tr>
    </thead>
    <tbody>
        @foreach($all_answers as $answer) 
        <tr>
            <td>
                {{$answer['question']}}
            </td>
            <td>
                {{$answer['yes']}}
            </td>
            <td>
                {{$answer['no']}}
            </td>
        </tr>

        @endforeach
    </tbody>
</table>
@endsection()
