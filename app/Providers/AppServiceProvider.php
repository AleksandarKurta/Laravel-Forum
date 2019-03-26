<?php

namespace App\Providers;

use View;
use App\Channel;
use App\Reply;
use App\User;
use App\Discussion;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::share('channels', Channel::all());
        View::share('replies_all', Reply::all());
        View::share('users_all', User::all());
        View::share('discussions_all', Discussion::all());
        
    }
}
