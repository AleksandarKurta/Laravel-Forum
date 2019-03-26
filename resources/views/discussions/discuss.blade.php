@extends('layouts.app')

@section('content')
    <div class="card bg-dark text-white">
        <div class="card-header text-center color-yellow">
            <h5>Create Discussion</h5>    
        </div>    

        <div class="card-body">

            @include('admin.includes.errors')

            <form action="{{ route('discussion.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label for="channel_id">Select Channel</label>
                    <select name="channel_id" id="channel_id" class="form-control">
                        @foreach($channels as $channel)
                            <option value="{{ $channel->id }}">{{ $channel->title }}</option>
                        @endforeach
                    </select>
                </div>
                @if($tags->count() > 0)
                <div class="form-group">
                    <label for="tags">Select Tags</label>
                        @foreach($tags as $tag)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->name }}
                                </label>
                            </div>
                        @endforeach
                </div>
                @endif
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ old('content') }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary">Create discussion</button>
                </div>
            </form>
        </div>
    </div>  
@endsection
