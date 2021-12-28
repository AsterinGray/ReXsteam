@extends('layout.main')

@section('title', 'Manage Games')

@section('content')
    @parent
    <div class="container">
        <h1>Manage Games</h1>
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
        <form action="{{route('games.index')}}" class="d-flex flex-column">
            <label for="search" class="mb-2">Filter by Games' Name</label>
            <input type="text" id="search" name="search" class="mb-5">

            <label for="category" class="mb-2">Filter Games by Category</label>
            <div class="row">
                @foreach ($genres as $genre)
                    <div class="col-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="genre" value="{{$genre->id}}" id="{{$genre->name}}">
                            <label class="form-check-label" for="{{$genre->name}}">
                                {{$genre->name}}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div>   
                <button type="submit" class="btn btn-primary my-3">Search</button>
            </div>
        </form>
        <div class="row">
            <div class="card mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>Create Game</div>
                    <div><a href="{{route('games.create')}}"><button class="btn btn-primary">Create</button></a></div>
                </div>
            </div>
        </div>
        <div class="row">
            <h1>Games</h1>
            @if ($games->count() > 0)
                @foreach ($games as $game)
                    <div class="col-3">
                        <div class="card mb-3">
                            <a href="{{route('games.show', $game)}}"><img src="{{$game->image_preview}}" class="card-img-top"></a>
                            <div class="card-body">
                                <h5 class="card-title">{{$game->title}}</h5>
                                <p>{{$game->genre->name}}</p>
                                <div class="d-flex">
                                    <form action="{{route('games.edit', $game)}}" method="get">
                                        @csrf    
                                        <button class="btn btn-primary" type="submit">
                                            Edit
                                        </button>
                                    </form>
                                    <form action="{{route('games.destroy', $game)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No games found</p>
            @endif
        </div>
        {{ $games->links() }}
    </div>
@endsection