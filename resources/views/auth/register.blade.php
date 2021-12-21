@extends('layout.main')

@section('title', 'Register')

@section('content')
    <form action={{route('register.action')}} method="POST">
        @csrf
        <input type="text" name="username">
        <input type="text" name="full_name">
        <input type="password" name="password">
        <input type="text" name="role">
        <button type="submit">Submit</button>
    </form>
@endsection