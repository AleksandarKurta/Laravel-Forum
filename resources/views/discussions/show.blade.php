@extends('layouts.app')

@section('content')
        <div class="card mb-3">
            <div class="card-header">
                <img src="{{ asset($discussion->user->profile->avatar) }}" alt="avatar" width="80px">
                <span>{{ $discussion->user->name }} <b>{{ $discussion->created_at->diffForHumans() }}</b> </span>
                @if($discussion->isBeingWatchedByAuthUser())
                    <a href="{{ route('discussion.unwatch', ['id' => $discussion->id]) }}" class="btn btn-secondary btn-sm float-right">Unwatch</a>
                @else
                    <a href="{{ route('discussion.watch', ['id' => $discussion->id]) }}" class="btn btn-secondary btn-sm float-right">Watch</a>
                @endif
            </div>

            <div class="card-body">
                <div class="text-center">
                    <h4>{{ $discussion->title }}</h4>
                    <p>{{ $discussion->content }}</p>
                </div>
            </div>

            <hr>

            @if($bestAnswer)
                <div class="text-center p-4">
                    <h3>Best answer</h3>
                    <div class="card">
                        <div class="card-header bg-success">
                            <img src="{{ asset($bestAnswer->user->profile->avatar) }}" alt="avatar" width="80px">
                            <span>{{ $bestAnswer->user->name }} <b>{{ $bestAnswer->created_at->diffForHumans() }}</b> </span>
                        </div>

                        <div class="card-body">
                            <p>{{ $bestAnswer->content }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="card-footer">
                {{ $discussion->replies->count() }} Replies
            </div>
        </div>

        @foreach($discussion->replies as $reply)
            <div class="card mb-3">
                <div class="card-header">
                    <img src="{{ asset($reply->user->profile->avatar) }}" alt="avatar" width="80px">
                    <span>{{ $reply->user->name }} <b>{{ $reply->created_at->diffForHumans() }}</b> </span>

                    @if(!$bestAnswer)
                        <a href="{{ route('discussion.best.answer', ['reply' => $reply]) }}" class="btn btn-info btn-sm float-right">Mark as best answer</a>
                    @endif
                </div>
    
                <div class="card-body">
                    <div class="text-center">
                        <p>{{ $reply->content }}</p>
                    </div>
                </div>
    
                <div class="card-footer">
                    <div class="row pl-3">
                        <div>
                            @switch($reply->isLikedByTheUser())
                            @case('liked')
                                @php
                                $i = 1;
                                @endphp
                                @break
                            @case('disliked')
                                @php
                                $i = 0;
                                @endphp
                                @break                     
                            @default
                                @php($i = 3)
                            @endswitch
                        <a href="{{ route('reply.likeOrDislike', ['id' => $reply->id, 'num' => 1]) }}" class="@if($i == 1) text-primary @else text-secondary @endif"><i class="fas fa-thumbs-up fa-1x"></i></a>&nbsp;&nbsp;
                        {{ count($reply->getLikers()) }} Likes &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ route('reply.likeOrDislike', ['id' => $reply->id, 'num' => 0]) }}" class="@if($i == 0) text-danger @else text-secondary @endif"><i class="fas fa-thumbs-down fa-1x"></i></a>
                        {{ count($reply->getDislikers()) }} Deslikes &nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    
                </div>
            </div>
        @endforeach

        @if(Auth::check())
            <div class="card">
                <div class="card-header">
                    Your reply
                </div>

                <div class="card-body">
                    <form action="{{ route('discussion.reply', ['id' => $discussion->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        @else 
            <div class="text-center mt-5 mb-5">
                <h3><a href="{{ route('login') }}">Sign in to leave a reply</a></h3>
            </div>
        @endif
@endsection