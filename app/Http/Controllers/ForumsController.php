<?php

namespace App\Http\Controllers;

use Auth;
use App\Discussion;
use App\Channel;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ForumsController extends Controller
{
    public function forum(){
        //$discussions = Discussion::orderBy('created_at', 'desc')->paginate(3);
        switch(request()->filter){
            case "me":
                $discussions = Discussion::where('user_id', Auth::id())->paginate(3);
                break;
            case "solved":
                $solved = [];
                foreach(Discussion::all() as $discussion):
                    if($discussion->hasBestAnswer()){
                        $solved[] = $discussion;
                    }
                endforeach;

                $discussions = new Paginator($solved, 3);
                $discussions->withPath('forum?filter=solved');

                break;
            case "unsolved":
                $unsolved = [];
                foreach(Discussion::all() as $discussion):
                    if(!$discussion->hasBestAnswer()){
                        $unsolved[] = $discussion;
                    }
                endforeach;

                $discussions = new Paginator($unsolved, 3);
                $discussions->withPath('forum?filter=unsolved');

                break;
            default:
                $discussions = Discussion::orderBy('created_at', 'desc')->paginate(3);
        }

        return view('forum', compact('discussions'));
    }

    public function channel($slug){
        $channel = Channel::where('slug', $slug)->first();
        return view('channel')->with('discussions' , $channel->discussions()->paginate(5));
    }
}
