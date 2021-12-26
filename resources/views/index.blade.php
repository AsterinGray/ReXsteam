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
@endsection
