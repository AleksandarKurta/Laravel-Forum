<?php

namespace App\Http\Controllers;

use App\Profile;
use SocialAuth;
use Illuminate\Http\Request;

class SocialsController extends Controller
{
    public function auth($provider){
        return SocialAuth::authorize($provider);
    }

    public function callback($provider){

        SocialAuth::login($provider, function($user,  $details){
            $user->email = $details->email;
            $user->name = $details->full_name;
            $user->save();
            $profile = Profile::where('user_id', '=', $user->id)->first();
            if($profile == null){
                $profile = new Profile;
                $profile->avatar = $details->avatar;
                $profile->user_id = $user->id;
                $profile->save();
            }
        });

        return redirect('/home');
    }
}
