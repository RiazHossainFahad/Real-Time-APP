<?php

namespace App\Http\Controllers;

use App\Like;
use App\Reply;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function like(Reply $reply)
    {
        $reply->like()->create([
            // 'user_id' => auth()->id(),
            'user_id' => 1,
        ]);

        // return response(['likes' => $reply->like()->get()], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function unlike(Reply $reply)
    {
        // $reply->like()->where(['user_id' => auth()->id()])->first()->delete();
        $reply->like()->where(['user_id' => 1])->first()->delete();
        // return response(null, Response::HTTP_NO_CONTENT);
    }
}