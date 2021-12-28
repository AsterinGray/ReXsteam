@extends('layout.main')

@section('title', $game->title)

@section('content')
    @parent
    <div class="container">
        <div class="row">
            <div class="col-8">
                <video src="{{$game->trailer_video}}" controls></video>
            </div>
            <div class="col-4">
                <img class="w-100" src="{{$game->image_preview}}" alt="">
                <h1>{{$game->title}}</h1>
                <p>{{$game->description}}</p>
                <p><b>Genre: </b>{{$game->genre->name}}</p>
                <p><b>Release Date: </b>{{$game->release_date}}</p>
                <p><b>Developer: </b>{{$game->developer}}</p>
                <p><b>Publisher: </b>{{$game->publisher}}</p>
            </div>
        </div>
        @auth
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Buy {{$game->title}}</h5>
                        <form action="">
                            <button type="submit" class="btn btn-primary">Add to Cart | Rp. {{number_format($game->price)}}</button>
                        </form>
                    </div>
                </div>
            </div>
        @endauth
        <div>
            <h1>About This Game</h1>
            <p>{{$game->long_description}}</p>
        </div>
    </div>

@endsection
