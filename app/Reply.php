<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['content', 'user_id', 'discussion_id'];
    protected $likers = [];
    protected $dislikers = [];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function discussion(){
        return $this->belongsTo('App\Discussion');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function isLikedByTheUser(){
        $this->countLikesAndDislikes();

        $user_id = Auth::id();

        $result = false;
        if(in_array($user_id, $this->likers)){
            $result = "liked";
        }elseif(in_array($user_id, $this->dislikers)){
            $result = "disliked";
        }
        return $result;
    }

    public function countLikesAndDislikes(){
        foreach($this->likes as $like):
            if($like->isLiked == 1){
                $this->likers[] = $like->user->id;
            }elseif($like->isLiked == 0){
                $this->dislikers[] = $like->user->id;
            }
        endforeach;
    }

    public function getLikers(){
        return $this->likers;
    }

    public function getDislikers(){
        return $this->dislikers;
    }
}
