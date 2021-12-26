@extends('layout.main')

@section('title', 'Check Age')

@section('content')
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
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">CONTENT IN THIS PAGE MAY NOT BE APPROPRIATE FOR ALL AGES <br> AND MAY NOT BE SAFE FOR WORK</h5>
                <form action={{route('age')}} method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="birth_date" class="form-label">Please insert your birthdate to continue</label>
                        <div class="d-flex">                            
                            <input type="date" name="birth_date" id="birth_date" class="form-control">
                            <button type="submit" class="btn btn-primary mx-2">Submit</button>
                        </div>
                    </div>
                </form>
                <form action={{route('age.cancel')}} method="POST">
                    @csrf
                    <button class="btn btn-secondary" type="submit">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection