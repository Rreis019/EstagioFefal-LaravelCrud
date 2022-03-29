@extends('layout')


@section('namePage')
Edit User
@endsection

@section('headerItems')
<a href="{{route('dashboard')}}">Dashboard</a>
@endsection

@section('content')

<form action="{{route('edit-user')}}" class="form_gray" method="post">
    @csrf
    <input type="hidden" value="{{$user->id}}" name="id">
    <table>
        <tr>
            <td><label for="name">Name</label></td>
            <td><input type="text" value="{{$user->name}}" name="name" id="name"></td>
        <tr>

        <tr>
            <td><label for="email">Email</label></td>
            <td><input type="text" value="{{$user->email}}" name="email" id="email"></td>
        <tr>

        <tr>
            <td><label for="password">Password</label></td>
            <td><input type="password" name="password" id="password"></td>
        <tr>
    </table>
    
    <span>@error('email') {{$message}} <br> @enderror</span>
    <span>@error('username') {{$message}} <br> @enderror</span>
    <span>@error('password') {{$message}} <br> @enderror</span>
    
    <button type="submit" id="btn_blue">Update</button>
</form>


                
@endsection



