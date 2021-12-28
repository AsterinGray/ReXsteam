@extends('layout.main')

@section('title', 'Create Game')

@section('content')
    @parent
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

        @if (Session::get('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="card-title text-center">CREATE GAME</div>
                <form action={{route('game.store')}} method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" id="description" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="long_description" class="form-label">Long Description</label>
                        <textarea type="text" name="long_description" id="long_description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="genre">Genre</label>
                        <select name="genre_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>Select Genre</option>
                            @foreach ($genres as $genre)
                                <option value="{{$genre->id}}">{{$genre->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="developer" class="form-label">Developer</label>
                        <input type="text" name="developer" id="developer" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="publisher" class="form-label">Publisher</label>
                        <input type="text" name="publisher" id="publisher" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" id="price" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="image_preview" class="form-label">Image Preview</label>
                        <input type="file" name="image_preview" id="image_preview" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="trailer_video" class="form-label">Trailer Video</label>
                        <input type="file" name="trailer_video" id="trailer_video" class="form-control" readonly>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="for_adult" name="for_adult">
                        <label class="form-check-label" for="for_adult">Only for Adult?</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
