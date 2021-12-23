@extends('layout.main')

@section('title', 'Profile')

@section('content')
    @if (Session::get('success'))
        {{Session::get('success')}}
    @endif
    <form action={{route('profile.update')}} method="POST">
        @csrf
        <input type="text" name="username" value="{{$user->username}}" readonly>
        <input type="text" name="level" value="{{$user->level}}" readonly>
        <input type="text" name="full_name" value="{{$user->full_name}}">
        <input type="password" name="current_password">
        <input type="password" name="password" id="">
        <input type="password" name="password_confirmation" id="">
        <button type="submit">Submit</button>
    </form>
@endsection