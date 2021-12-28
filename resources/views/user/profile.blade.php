@extends('layout.main')

@section('title', 'Profile')

@section('content')
    @parent
    <div class="d-flex flex-column justify-content-center align-items-center min-vh-100">
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
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
                <h5 class="card-title text-center">Profile</h5>
                <form action={{route('profile.update')}} method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="profile_image" class="form-label">
                            <img style="width: 8rem" src="{{ asset("storage/".$user->profile_image)}}" alt="">
                        </label>
                        <input type="file" name="profile_image" id="username" value="{{$user->profile_image}}" class="form-control" readonly>
                    </div>
                    <div class="d-flex">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" value="{{$user->username}}" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <input type="text" name="level" id="level" value="{{$user->level}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" name="full_name" id="full_name" value="{{$user->full_name}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" name="current_password" id="current_password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">New Password Confirmation</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
