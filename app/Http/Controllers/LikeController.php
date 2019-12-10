<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
use App\Like;
use App\Reply;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LikeController extends Controller
{
    /**
     * Create a new LikeController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function like(Reply $reply)
    {
        $reply->like()->create([
            'user_id' => auth()->id(),
        ]);
        broadcast(new LikeEvent($reply->id, 1))->toOthers();
        return response("liked", Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function unlike(Reply $reply)
    {
        $reply->like()->where('user_id', auth()->id())->first()->delete();

        broadcast(new LikeEvent($reply->id, 0))->toOthers();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}