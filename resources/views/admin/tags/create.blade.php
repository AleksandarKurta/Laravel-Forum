@extends('layouts.app')

@section('content')
    <div class="card text-white bg-dark">
        <div class="card-header text-center color-yellow">
            <h5>Create Tag</h5>    
        </div>    

        <div class="card-body">

            @include('admin.includes.errors')

            <form action="{{ route('tags.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Create tag</button>
                </div>
            </form>
        </div>
    </div>    
@endsection