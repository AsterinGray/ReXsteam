@extends('layout.main')
@section('title', 'Friends')
@section('content')
<div class="container title p-1">
    <h4 class="fw-normal p-1">Friends</h4>
    <div class="row">
        <div class="col-md-3">
            <h5 class="mt-5 mb-3">Add Friend</h5>
            <form class="input-group mb-3" method="POST" action="{{route('friends.store')}}" enctype="multipart/form-data">
                @csrf
                <input type="text" class="form-control" minlength="1" placeholder="Username" name="username">
                <button class="btn btn-secondary ms-1" type="submit">Add</button>
            </form>
        </div>
        <div class="col-md-3 mt-5">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="mb-3">
        <h5 class="mt-5 mb-3">Incoming Friend Request</h5>
        <ul class="list-group list-group-horizontal overflow-auto">
            @forelse ($incoming_friend as $req)
            <li class="list-group-item border-0">
                <div class="card bg-light px-2 shadow" style="width: 20rem;">
                    <div class="row no-gutters">
                        <div class="col-md-4 align-self-center me-0">
                            <img src="{{$req->detail->profile_image}}" class="card-img">
                        </div>
                        <div class="col-md-8 p-0">
                            <div class="card-body">
                            <h5 class="card-title text-truncate">{{$req->detail->full_name}}</h5>
                            <p class="card-text">{{$req->detail->role}}</p>
                            <p class="card-text"><small class="text-muted">Level {{$req->detail->level}}</small></p>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-evenly">
                            <a class="btn friend p-0" href="{{route('friends.edit', $req->id)}}"><button class="btn btn-theme float-left" type="submit"><i class="fa fa-user-plus"></i>&nbsp;Accept</button></a>
                            <form action="{{route('friends.destroy', $req->id)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-theme float-right" type="submit"><i class="fa fa-user-times"></i>&nbsp;Reject</button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
            @empty
            <h4 class="fw-normal fs-5 p-1">There is no incoming friend request</h4>
            @endforelse
        </ul>
    </div>
    <div class="mb-3">
        <h5 class="mt-5 mb-3">Pending Friend Request</h5>
        <ul class="list-group list-group-horizontal overflow-auto">
            @forelse ($pending_friend as $req)
            <li class="list-group-item border-0">
                <div class="card bg-light px-2 shadow" style="width: 20rem;">
                    <div class="row no-gutters">
                        <div class="col-md-4 align-self-center me-0">
                            <img src="{{$req->detail->profile_image}}" class="card-img">
                        </div>
                        <div class="col-md-8 p-0">
                            <div class="card-body">
                            <h5 class="card-title text-truncate">{{$req->detail->full_name}}</h5>
                            <p class="card-text">{{$req->detail->role}}</p>
                            <p class="card-text"><small class="text-muted">Level {{$req->detail->level}}</small></p>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <form action="{{route('friends.destroy', $req->id)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-theme float-right" type="submit"><i class="fa fa-user-times"></i>&nbsp;Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
            @empty
            <h4 class="fw-normal fs-5 p-1">There is no pending friend request</h4>
            @endforelse
        </ul>
    </div>
    <div class="mb-3">
        <h5 class="mt-5 mb-3">Your Friends</h5>
        <ul class="list-group list-group-horizontal overflow-auto">
            @forelse ($friend as $req)
            <li class="list-group-item border-0">
                <div class="card bg-light px-2 shadow" style="width: 20rem;">
                    <div class="row no-gutters">
                        <div class="col-md-4 align-self-center me-0">
                            <img src="{{$req->detail->profile_image}}" class="card-img">
                        </div>
                        <div class="col-md-8 p-0">
                            <div class="card-body">
                            <h5 class="card-title text-truncate">{{$req->detail->full_name}}</h5>
                            <p class="card-text">{{$req->detail->role}}</p>
                            <p class="card-text"><small class="text-muted">Level {{$req->detail->level}}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @empty
            <h4 class="fw-normal fs-5 p-1">There is no friend</h4>
            @endforelse
        </ul>
    </div>
</div>
@endsection
