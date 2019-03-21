<?php

namespace App\Http\Controllers;

use Session;
use Auth;
use App\Like;
use App\Reply;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function likeOrDislike($id, $num){
        $like = Like::where('reply_id', '=', $id)->where('user_id', '=', Auth::id())->first();
        if(!isset($like->isLiked)){
            Like::create([
                'reply_id' => $id,
                'isLiked' => $num,
                'user_id' => Auth::id()
            ]);
        }else{
            $like->update(['isLiked' => $num]);
        }
    
        Session::flash('success', 'You liked the reply.');

        return back();
    }

    public function bestAnswer(Reply $reply){
        $reply->best_answer = 1;

        $reply->save();

        $reply->user->profile->points += 100;
        $reply->user->profile->save();

        Session::flash('success', 'Reply has been marked as best answer.');

        return back();
    }

    public function edit(Reply $reply){
        return view('replies.edit', compact('reply'));
    }

    public function update(Reply $reply){
        $attributes = request()->validate([
            'content' => 'required'
        ]);

        $reply->update($attributes);

        Session::flash('success', 'Your reply has been updated.');

        return redirect()->route('discussion', ['slug' => $reply->discussion->slug]);
    }
}
