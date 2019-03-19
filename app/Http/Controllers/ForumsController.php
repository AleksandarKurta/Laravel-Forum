<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Channel;
use Illuminate\Http\Request;

class ForumsController extends Controller
{
    public function forum(){
        $discussions = Discussion::orderBy('created_at', 'desc')->paginate(3);
        return view('forum', compact('discussions'));
    }

    public function channel($slug){
        $channel = Channel::where('slug', $slug)->first();
        return view('channel')->with('discussions' , $channel->discussions()->paginate(5));
    }
}
