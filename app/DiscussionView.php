<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class DiscussionView extends Model
{
    protected $table = 'discussion_views';

    public static function createViewLog($discussion) {
            $discussionViews = new DiscussionView();
            $discussionViews->discussion_id = $discussion->id;
            $discussionViews->titleslug = $discussion->title;
            $discussionViews->url = \Request::url();
            $discussionViews->session_id = \Request::getSession()->getId();
            $discussionViews->user_id = \Auth::user()->id;
            $discussionViews->ip = \Request::getClientIp();
            $discussionViews->agent = \Request::header('User-Agent');
            $discussionViews->save();
    }

}
