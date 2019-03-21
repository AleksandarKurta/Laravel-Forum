@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-center text-white">
            <h5>Edit Reply</h5>    
        </div>    

        <div class="card-body">

            @include('admin.includes.errors')

            <form action="{{ route('reply.update', ['reply' => $reply]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ $reply->content }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Edit reply</button>
                </div>
            </form>
        </div>
    </div>  
@endsection