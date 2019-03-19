<?php

namespace App\Http\Controllers;

use Session;
use Auth;
use App\Like;
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
}
