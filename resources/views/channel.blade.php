@extends('layouts.app')

@section('content')
    @if($discussions->count() > 0)
        @foreach ($discussions as $discussion)
            <div class="card mb-3">
                <div class="card-header">
                    {{ $discussion->discusion_views->count() }} Views
                    <img src="{{ asset($discussion->user->profile->avatar) }}" alt="avatar" width="80px">
                    <span>{{ $discussion->user->name }} <b>{{ $discussion->created_at->diffForHumans() }}</b> </span>

                    @if($discussion->hasBestAnswer())
                        <span class="btn btn-danger btn-sm float-right">closed</span>
                    @else 
                        <span class="btn btn-success btn-sm float-right">open</span>
                    @endif

                    @if($discussion->user_id == Auth::id())
                        @if(!$discussion->hasBestAnswer())
                            <a href="{{ route('discussion.edit', ['discussion' => $discussion]) }}" class="btn btn-primary btn-sm float-right mr-1">Edit</a>
                        @endif
                    @endif

                    <a href="{{ route('discussion', ['slug' => $discussion->slug]) }}" class="btn btn-secondary btn-sm float-right mr-1">View</a>
                </div>

                <div class="card-body">
                    <div class="text-center">
                        <h4>{{ $discussion->title }}</h4>
                        <p>{{ str_limit($discussion->content, 50) }}</p>
                    </div>
                </div>

                <div class="card-footer">
                    {{ $discussion->replies->count() }} Replies
                    <a href="{{ route('channel', ['slug' => $discussion->channel->slug]) }}" class="btn btn-secondary btn-sm float-right">{{ $discussion->channel->title }}</a>
                </div>
            </div>
        @endforeach
    @else 
        <div class="text-center">
            <h3>No discussions found matching you criteria</h3>
        </div>
    @endif

    <div class="text-center">
        {{ $discussions->links() }}
    </div>
@endsection