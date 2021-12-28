@extends('layout.main')

@section('title', 'Home')

@section('content')
    @parent
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="container">
        <div class="row">
            @if ($games->count() > 0)
                @foreach ($games as $game)
                    <div class="col-3">
                        <div class="card mb-3">
                            <a href="{{route('game.detail', $game->id)}}"><img src="{{asset("storage/".$game->image_preview)}}" class="card-img-top"></a>
                            <div class="card-body">
                                <h5 class="card-title">{{$game->title}}</h5>
                                <p>{{$game->genre->name}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No games found</p>
            @endif
        </div>
    </div>
@endsection
