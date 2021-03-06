@extends('layout.main')

@section('title', $game->title)

@section('content')
    @parent
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (Session::get('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
        <div class="row mb-3">
            <video class="col-8" src="{{asset('storage/'.$game->trailer_video)}}" controls></video>
            <div class="col-4">
                <img class="w-100" src="{{asset('storage/'.$game->image_preview)}}" alt="">
                <h1>{{$game->title}}</h1>
                <p>{{$game->description}}</p>
                <p><b>Genre: </b>{{$game->genre->name}}</p>
                <p><b>Release Date: </b>{{date('d-m-Y', strtotime($game->release_date))}}</p>
                <p><b>Developer: </b>{{$game->developer}}</p>
                <p><b>Publisher: </b>{{$game->publisher}}</p>
            </div>
        </div>
        @if (!$owned)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Buy {{$game->title}}</h5>
                        <form action="{{route('game.add', ['id' => $game->id])}}" enctype="multipart/form-data">
                            @csrf
                            <button type="submit" class="btn btn-primary">Add to Cart | Rp. {{number_format($game->price)}}</button>
                        </form>
                </div>
            </div>
        </div>
        @endif
        <div>
            <h1>About This Game</h1>
            <p>{{$game->long_description}}</p>
        </div>
    </div>

@endsection
