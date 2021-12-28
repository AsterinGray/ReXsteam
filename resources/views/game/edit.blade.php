@extends('layout.main')
@section('title', 'Update Game ' . $game->title)
@section('content')
@parent
<div class="container title p-1">
    <h4 class="fw-normal p-1">Update Games</h4>
    @if ($errors->any())
    <div class="px-4 alert alert-danger">
        <strong>There were {{$errors->count()}} errors with your submission</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('games.update', $game)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="mt-4">
          <label for="description" class="form-label">Game Description</label>
          <textarea name="description" class="form-control" rows="2" aria-describedby="gameDescHelp">{{$game->description}}</textarea>
          <div id="gameDescHelp" class="form-text">Write a single sentence about the game.</div>
        </div>
        <div class="mt-4">
          <label for="long_description" class="form-label">Game Long Description</label>
          <textarea name="long_description" class="form-control" rows="5" aria-describedby="gameLongDescHelp">{{$game->long_description}}</textarea>
          <div id="gameLongDescHelp" class="form-text">Write a few sentence about the game.</div>
        </div>
        <div class="mt-4">
            <label for="genre" class="form-label">Game Category</label>
            <select class="form-select" name="genre_id">
                @foreach ($genres as $genre)
                    <option value="{{$genre->id}}" @if ($genre->id == $game->genre_id) selected @endif>{{$genre->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-4">
          <label for="price" class="form-label">Game Price</label>
          <input type="text" name="price" class="form-control" value="{{$game->price}}">
        </div>
        <div class="mt-4">
            <div class="form-group files color">
                <label>Game Cover</label>
                <input name="image_preview" class="mt-2" type="file" class="form-control">
            </div>
       </div>
       <div class="mt-4">
        <div class="form-group video color">
            <label>Game Trailer</label>
            <input name="trailer_video" class="mt-2" type="file" class="form-control">
        </div>
      </div>
      <div class="justify-content-end d-flex mt-4 mb-5">
        <a class="btn p-0 me-2" href="{{route('games.index')}}"><button class="btn btn-light" type="button">Cancel</button></a>
        <button type="submit" class="btn btn-secondary">Save</button>
      </div>
    </form>
</div>
@endsection
