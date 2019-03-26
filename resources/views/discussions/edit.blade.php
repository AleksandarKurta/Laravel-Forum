@extends('layouts.app')

@section('content')
    <div class="card bg-dark text-white mt-5">
        <div class="card-header text-center color-yellow">
            <h5>Edit Discussion</h5>    
        </div>    

        <div class="card-body">

            @include('admin.includes.errors')

            <form action="{{ route('discussion.update', ['discussion' => $discussion]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ $discussion->content }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary col-md-3">Edit discussion</button>
                </div>
            </form>
        </div>
    </div>  
@endsection