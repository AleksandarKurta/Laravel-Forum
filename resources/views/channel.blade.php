@extends('layouts.app')

@section('content')
    @if($discussions->count() > 0)
        @foreach ($discussions as $discussion)
            <div class="row pt-4 pb-2 forum-discussion">
                <div class="col-md-1 text-center">
                    views
                    <p>{{ $discussion->discusion_views->count() }}</p>
                </div>
                <div class="col-md-1 text-center">
                    replies
                    <p>{{ $discussion->replies->count() }}</p>
                </div>
                <div class="col-md-8">
                    <h5><a href="{{ route('discussion', ['slug' => $discussion->slug]) }}" class="title">{{ str_limit($discussion->title, 80) }}</a></h5>
                    Started <span class="color-yellow">{{ $discussion->user->name }}</span> {{ $discussion->created_at->diffForHumans() }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @if($discussion->tags->count() > 0)
                        <span class="text-info">#Tags </span>
                    @elseif($discussion->tags->count() == 1)
                        <span class="text-info">#Tag </span>
                    @endif
                    @foreach($discussion->tags as $tag)
                        <a href="" class="btn btn-info btn-sm mr-1">{{ $tag->name }}</a>
                    @endforeach
                </div>
                <div class="col-md-2 font-18">
                        <div class="text-center">
                        @if($discussion->hasBestAnswer())
                            Status - <span class="btn btn-danger btn-sm">Closed</span>
                        @else 
                            Status - <span class="btn btn-success btn-sm">Open</span>
                        @endif
                        </div>
                    <div class="text-center pt-1">
                        <span>Channel - </span>
                        <span class="color-yellow"> {{ $discussion->channel->title }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    @else   
        <div class="text-center text-white">
            <h3>No results fount matching your criteria!</h3>
        </div>
    @endif

    <div class="text-center pt-3">
        {{ $discussions->links() }}
    </div>
@endsection