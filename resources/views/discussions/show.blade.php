@extends('layouts.app')

@section('content')
        <div class="card mb-3">
            <div class="card-header">
                <img src="{{ asset($discussion->user->profile->avatar) }}" alt="avatar" width="80px">
                <span>{{ $discussion->user->name }} <b>{{ $discussion->created_at->diffForHumans() }}</b> </span>
            </div>

            <div class="card-body">
                <div class="text-center">
                    <h4>{{ $discussion->title }}</h4>
                    <p>{{ $discussion->content }}</p>
                </div>
            </div>

            <div class="card-footer">
                {{ $discussion->replies->count() }} Replies
            </div>
        </div>

        @foreach($discussion->replies as $reply)
            <div class="card mb-3">
                <div class="card-header">
                    <img src="{{ asset($reply->user->profile->avatar) }}" alt="avatar" width="80px">
                    <span>{{ $reply->user->name }} <b>{{ $reply->created_at->diffForHumans() }}</b> </span>
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
@endsection