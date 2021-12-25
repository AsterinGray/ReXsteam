@extends('layout.main')

@section('title', 'Register')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center min-vh-100">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="card-title text-center">REGISTER</div>
                <form action={{route('register.action')}} method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" name="full_name" id="full_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" name="role" id="role" class="form-control">
                    </div>
                    
                    <div><a href={{route('register')}}>Don't have an account?</a></div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection