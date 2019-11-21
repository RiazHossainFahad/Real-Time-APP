<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Resources\ReplyResource;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return ReplyResource::collection($question->reply);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Question $question)
    {
        $request->validate([
            'body' => 'required|max:255',
            'question_id' => 'required|integer',
        ]);

        $reply = $question->reply()->create($request->all());

        return response(['data' => new ReplyResource($reply)], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Reply $reply)
    {
        return new ReplyResource($reply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question, Request $request, Reply $reply)
    {
        $validatedData = $request->validate([
            'body' => 'required|string|max:255',
            'user_id' => 'nullable|integer',
            'question_id' => 'nullable|integer',
        ]);

        $reply->update($validatedData);
        return response(['data' => new ReplyResource($reply)], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}