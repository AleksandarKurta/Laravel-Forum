@extends('layouts.app')

@section('content')
    @foreach ($discussions as $discussion)
        <div class="card mb-3">
            <div class="card-header">
                <img src="{{ asset($discussion->user->profile->avatar) }}" alt="avatar" width="80px">
                <span>{{ $discussion->user->name }} <b>{{ $discussion->created_at->diffForHumans() }}</b> </span>
                <a href="{{ route('discussion', ['slug' => $discussion->slug]) }}" class="btn btn-secondary btn-sm float-right">View</a>
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

    <div class="text-center">
        {{ $discussions->links() }}
    </div>
@endsection
