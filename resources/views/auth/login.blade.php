@extends('layout.main')

@section('title', 'Login')

@section('content')
    <form action={{route('login.action')}} method="POST">
        @csrf
        <input type="text" name="username">
        <input type="password" name="password">
        <input type="checkbox" name="remember_me" id="">
        <button type="submit">Submit</button>
    </form>
@endsection