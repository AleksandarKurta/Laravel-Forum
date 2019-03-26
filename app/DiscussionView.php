<?php

namespace App;

use Auth;
use Request;
use Illuminate\Database\Eloquent\Model;

class DiscussionView extends Model
{
    protected $table = 'discussion_views';

    public static function createViewLog($discussion) {
            $userId = 0;
            if(isset(Auth::user()->id)){
                $userId = Auth::user()->id;
            }
            $discussionViews = new DiscussionView();
            $discussionViews->discussion_id = $discussion->id;
            $discussionViews->titleslug = $discussion->title;
            $discussionViews->url = Request::url();
            $discussionViews->session_id = Request::getSession()->getId();
            $discussionViews->user_id = $userId;
            $discussionViews->ip = Request::getClientIp();
            $discussionViews->agent = Request::header('User-Agent');
            $discussionViews->save();
    }

}
