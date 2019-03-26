@extends('layouts.app')

@section('content')
    <div class="card text-white bg-dark">
        <div class="card-header text-center color-yellow">
            <h5>Create Channel</h5>    
        </div>    

        <div class="card-body">

            @include('admin.includes.errors')

            <form action="{{ route('channels.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary">Create channel</button>
                </div>
            </form>
        </div>
    </div>    
@endsection
