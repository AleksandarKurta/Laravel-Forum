<?php

namespace App\Http\Controllers;

use Session;
use Auth;
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
        return view('discussions.show', compact('discussion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $attributes = request()->validate([
            'content' => 'required'
        ]);

        $attributes['user_id'] = Auth::id();
        $attributes['discussion_id'] = $id;

        Reply::create($attributes);

        Session::flash('success', 'Replied successfully to discussion.');

        return back();
    }
}
