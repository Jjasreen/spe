@extends('layout')

@section('content')
<h1>Admin List</h1>
<a href="/admins/create" class="btn btn-secondary btn-sm">Add Admins to SPE</a>
<br>
<br>
<table class="table">   
    <thead>
        <tr>            
            <th>Name</th>
            <th>Email</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($admins as $ad)
        <tr>
            <td>{{$ad->name}}</td>
            <td>{{$ad->email}}</td>           
            <td>
                <a href="/admins/{{$ad->id}}/update" class="btn btn-primary btn-sm">Edit</a>
                <a href="/admins/{{$ad->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection()