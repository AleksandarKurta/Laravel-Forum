@extends('layouts.app')

@section('content')
    <div class="card text-white bg-dark">
        <div class="card-header bg-dark text-center color-yellow">
            <h5>Edit Channel</h5>    
        </div>    

        <div class="card-body">

            @include('admin.includes.errors')

            <form action="{{ route('channels.update', ['channel' => $channel]) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ $channel->title }}" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary">Update channel</button>
                </div>
            </form>
        </div>
    </div>    
@endsection