@extends('layouts.app')

@section('content')
        <div class="pt-2 pb-2 bg-dark-gray m-0">
            <div class="row">
                <div class="col-md-2 text-center">
                    Author
                </div>
                <div class="col-md-10">
                    Discussion: {{ str_limit($discussion->title, 50) }}! ( Views {{ $discussion->discusion_views->count() }} )
                </div>
            </div>
        </div>

        <div class="mt-2 mb-2">
            <div class="row">
                <div class="col-md-2 text-center">
                    <div class="card bg-dark">
                        <div class="card-header text-center">
                            <h5 class="color-yellow pb-0 mb-1">{{ $discussion->user->name }}</h5> 
                            @if($discussion->user->admin)
                                <h6 class="pb-0 mb-1">Admin</h6>  
                            @endif
                            <span class="pts">Reputation Points  ({{ $discussion->user->profile->points }})</span>
                        </div>

                        <div class="card-body">
                            <img src="{{ asset($discussion->user->profile->avatar) }}" alt="avatar" width="100px">
                        </div>

                        <div class="card-footer">
                            Discussions: {{ $discussion->user->discussions->count() }}
                            Replies: {{ $discussion->user->replies->count() }}
                        </div>
                    </div>
                </div>

                <div class="col-md-10 d-flex align-items-stretch">
                    <div class="card mb-3 bg-dark">
                        <div class="card-header">
                            <h5 class="color-yellow">{{ $discussion->title }}</h5>
                            <span>Started {{ $discussion->created_at->diffForHumans() }}</span>
                            @if($discussion->hasBestAnswer())
                                <span class="btn btn-danger btn-sm float-right ml-1">closed</span>
                            @else 
                                <span class="btn btn-success btn-sm float-right ml-1">open</span>
                            @endif
                                
                            @if($discussion->isBeingWatchedByAuthUser())
                                <a href="{{ route('discussion.unwatch', ['id' => $discussion->id]) }}" class="btn btn-secondary btn-sm float-right">Unwatch</a>
                            @else
                                @if(!$discussion->hasBestAnswer())
                                    <a href="{{ route('discussion.watch', ['id' => $discussion->id]) }}" class="btn btn-primary btn-sm float-right">Watch</a>
                                @endif
                            @endif
            
                            @if($discussion->user_id == Auth::id())
                                @if(!$discussion->hasBestAnswer())
                                    <a href="{{ route('discussion.edit', ['discussion' => $discussion]) }}" class="btn btn-warning btn-sm float-right mr-1">Edit</a>
                                @endif
                            @endif
                        </div>
            
                        <div class="card-body">
                            <div class="text-center">
                                {!! Markdown::convertToHtml($discussion->content) !!}
                            </div>
                        </div>
            
                        <hr>
            
                        @if($bestAnswer)
                            <div class="text-center p-4">
                                <h3>Best answer</h3>
                                <div class="card bg-success">
                                    <div class="card-header">
                                        <img src="{{ asset($bestAnswer->user->profile->avatar) }}" alt="avatar" width="80px">
                                        <span>{{ $bestAnswer->user->name }} <b>{{ $bestAnswer->created_at->diffForHumans() }}</b> ({{ $bestAnswer->user->profile->points }}) points</span>
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
                </div>
            </div>
        </div>

        @foreach($discussion->replies as $reply)
        <div class="mt-2 mb-2">
                <div class="row">
                    <div class="col-md-2 text-center pb-2 mb-2">
                        <div class="card bg-dark">
                            <div class="card-header text-center">
                                <h5 class="color-yellow pb-0 mb-1">{{ $reply->user->name }}</h5> 
                                @if($reply->user->admin)
                                    <h6 class="pb-0 mb-1">Admin</h6>  
                                @endif
                                <span class="pts">Reputation Points  ({{ $reply->user->profile->points }})</span>
                            </div>
    
                            <div class="card-body">
                                <img src="{{ asset($reply->user->profile->avatar) }}" alt="avatar" width="100px">
                            </div>
    
                            <div class="card-footer">
                                Discussions: {{ $reply->user->discussions->count() }}
                                Replies: {{ $reply->user->replies->count() }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10 d-flex align-items-stretch">
                        <div class="card mb-3 bg-dark">
                            <div class="card-header">
                                <h6 class="color-yellow">Reply: {{ $discussion->title }}</h6>
                                @if(!$bestAnswer)
                                    @if($discussion->user->id == Auth::id())
                                        <a href="{{ route('discussion.best.answer', ['reply' => $reply]) }}" class="btn btn-info btn-sm float-right">Mark as best answer</a>
                                    @endif
                                @endif

                                @if(!$reply->best_answer)
                                    @if($reply->user_id == Auth::id())
                                        <a href="{{ route('reply.edit', ['reply' => $reply]) }}" class="btn btn-warning btn-sm float-right mr-1">Edit  reply</a>
                                    @endif
                                @endif
                            </div>
                
                            <div class="card-body">
                                <div class="text-center">
                                    {!! \Michelf\Markdown::defaultTransform($reply->content) !!}
                                
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
                    </div>
                </div>
            </div>
        @endforeach

        <hr>

        @if(Auth::check())
            @if(!$discussion->hasBestAnswer())
                <div class="card text-white bg-dark">
                    <div class="card-header text-center">
                        <h4>Leave a reply</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('discussion.reply', ['id' => $discussion->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary col-md-4">Reply</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        @else 
            <div class="text-center mt-5 mb-5">
                <h3><a href="{{ route('login') }}">Sign in to leave a reply</a></h3>
            </div>
        @endif
@endsection