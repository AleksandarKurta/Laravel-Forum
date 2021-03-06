<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['title', 'content', 'user_id', 'channel_id', 'slug'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function channel(){
        return $this->belongsTo('App\Channel');
    }

    public function replies(){
        return $this->hasMany('App\Reply');
    }

    public function watchers(){
        return $this->hasMany('App\Watcher');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public function isBeingWatchedByAuthUser(){
        $userId = Auth::id();

        $watchersIds = [];
        foreach($this->watchers as $watcher):
            $watchersIds[] = $watcher->user_id;
        endforeach;

        $result = false;
        if(in_array($userId, $watchersIds)){
            $result = true;
        }
        return $result;
    }

    public function hasBestAnswer(){
        $result = false;
        foreach($this->replies as $reply){
            if($reply->best_answer){
                $result = true;
            }
        }
        return $result;
    }

    public function discusion_views(){
        return $this->hasMany('App\DiscussionView');
    }
}
