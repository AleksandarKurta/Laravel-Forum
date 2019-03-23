@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-center text-white">
            <h5>Edit Tag</h5>    
        </div>    

        <div class="card-body">

            @include('admin.includes.errors')

            <form action="{{ route('tags.update', ['tag' => $tag]) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ $tag->name }}" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Update tag</button>
                </div>
            </form>
        </div>
    </div>    
@endsection