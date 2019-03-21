<?php

namespace App\Http\Controllers;

use Session;
use Auth;
use Notification;
use App\User;
use App\Reply;
use App\Discussion;
use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussions.discuss');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        $attributes = request()->validate([
            'title' => 'required',
            'content' => 'required',
            'channel_id' => 'required' 
        ]);

        $attributes['user_id'] = Auth::id();
        $attributes['slug'] = str_slug($attributes['title']);

        $discussion = Discussion::create($attributes);

        Session::flash('success', 'Discussion created successfully.');

        return redirect()->route('discussion', ['slug' =>  $discussion->slug ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $discussion = Discussion::where('slug', $slug)->first();

        $bestAnswer = $discussion->replies()->where('best_answer', 1)->first();
        return view('discussions.show', compact('discussion', 'bestAnswer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Discussion $discussion)
    {
        return view('discussions.edit', compact('discussion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Discussion $discussion)
    {
        $attributes = request()->validate([
            'content' => 'required'
        ]);

        $discussion->update($attributes);

        Session::flash('success', 'Discussion updated successfully.');

        return redirect()->route('discussion', ['slug' => $discussion->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function reply($id){
        $discussion = Discussion::find($id);

        $attributes = request()->validate([
            'content' => 'required'
        ]);

        $attributes['user_id'] = Auth::id();
        $attributes['discussion_id'] = $id;

        $reply = Reply::create($attributes);

        $reply->user->profile->points += 25;
        $reply->user->profile->save();

        $watchers = [];
        foreach($discussion->watchers as $watcher){
            $watchers[] = User::find($watcher->user_id);
        }

        Notification::send($watchers, new \App\Notifications\NewReplyAdded($discussion));

        Session::flash('success', 'Replied successfully to discussion.');

        return back();
    }
}
