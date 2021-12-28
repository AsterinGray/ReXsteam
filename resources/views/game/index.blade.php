@extends('layout.main')
@section('title', 'Manage Games')
@section('content')
@parent
<div class="container title p-1">
    <h4 class="fw-normal p-1">Manage Games</h4>
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif
    <form action="{{route('games.index')}}">
        <div class="row">
            <div class="col-md-3">
                <h5 class="mt-4 mb-3">Filter by Games Name</h5>
                <input type="search" class="form-control" placeholder="Game Name" name="search">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <h5 class="mt-2 mb-3">Filter by Games Category</h5>
                <div class="col-12">
                    @foreach ($genres as $genre)
                        <div class="form-check me-3">
                        <input class="form-check-input" type="checkbox" name="genres[]" value="{{$genre->id}}" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{$genre->name}}
                        </label>
                        </div>
                    @endforeach
                </div>
                <button class="btn btn-secondary rounded mt-2" type="submit">Search</button>
            </div>
        </div>
    </form>
    <div class="row mt-4">
        @forelse ($games as $game)
        <div class="col-3">
            <div class="card mb-3">
                <a href="{{route('game.detail', ["id" => $game->id])}}"><img src="{{asset('storage/'.$game->image_preview)}}" class="card-img-top"></a>
                <div class="card-body">
                    <h5 class="card-title">{{$game->title}}</h5>
                    <p>{{$game->genre->name}}</p>
                </div>
                <div class="card-footer d-flex justify-content-evenly">
                    <a class="btn p-0" href="{{route('games.edit', $game->id)}}"><button class="btn btn-theme float-left" type="submit"><i class="fa fa-pencil"></i>&nbsp;Update</button></a>
                    <button class="btn btn-theme float-right" data-bs-toggle="modal" data-bs-target="#delete-modal-{{$game->id}}" type="submit">
                        <i class="fa fa-trash"></i>&nbsp;Delete
                    </button>
                </div>
            </div>
        </div>
        @empty
        <h4 class="fw-normal fs-5 p-1">There are no games content can be showed right now</h4>
        @endforelse
    </div>
    <nav>
        <ul class="pagination justify-content-start">
            Showing {!! $games->firstItem() !!} to {!! $games->lastItem() !!} of {!! $games->total() !!} results
        </ul>
        <ul class="pagination justify-content-end">
            {!! $games->links() !!}
        </ul>
    </nav>
    <div class="justify-content-end d-flex">
        <a class="btn p-0 mb-5" href="{{route('games.create')}}"><button class="btn btn-secondary rounded-circle" type="submit"><i class="fa fa-plus-circle"></i></button></a>
    </div>
</div>
@foreach ($games as $game)
<div class="modal fade" id="delete-modal-{{$game->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Delete Cart</h5>
            </div>
            <form action="{{ route('games.destroy', $game->id) }}" method="post">
                @csrf
                @method('delete')
                <div class="modal-body">
                    Are you sure you want to delete this game? All of your data will be permanently removed from our servers forever. This action cannot be undone.
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
