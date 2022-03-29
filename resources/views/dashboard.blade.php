@extends('layout')

@section('namePage')
Dashboard
@endsection

@section('headerItems')
@endsection

@section('content')

<div style="witdh=100%">
<table id="table_green" style="margin-bottom: 15px;">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>
    
    
    @foreach ($users as $user)
    <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->created_at}}</td>
        <td>
            
            <a class="btn_crud" href="edit-user/{{$user->id}}">Edit</a>
            @if(Session::get('userId') != $user->id)
            <a class="btn_crud" href="delete-user/{{$user->id}}">Delete</a>
            @endif
        </td>
    </tr>
    @endforeach
</table>

    <a href="add-user" id="btn_green">Add User</a>
</div>

@if(Session::has('error'))
    <div class="alert alert-success">
        {{Session::get('error')}}
    </div>
    @endif
    
    @if(Session::has('sucess'))
    <div class="alert alert-success">
        {{Session::get('sucess')}}
    </div>
    @endif
    
    @endsection
    
    
    