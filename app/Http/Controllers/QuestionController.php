<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Question;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**Get all the question and the latest one will fetch first */
        return QuestionResource::collection(Question::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /***Validate the request before storing */
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
        ]);

        /**Generate Slug for the title */
        $validatedData['slug'] = str_slug($request->title);

        /**Check for uniqueness of the slug....If Not, Append a random unique id based on the microtime */
        if (Question::where('slug', $validatedData['slug'])->first()) {
            $validatedData['slug'] = $validatedData['slug'] . '-' . uniqid();
        }

        /**Save the question and store it in $question */
        $question = Question::create($validatedData);

        /**Return response with question and status code 201*/
        return response(['question' => $question], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        /**For route model binding, it will auto fetch the corresponding question */
        /**Return the resource */
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'body' => 'nullable',
            'user_id' => 'nullable|integer',
            'category_id' => 'nullable|integer',
        ]);
        /**Update the data's */
        $question->update($validatedData);

        return response(['data' => new QuestionResource($question)], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}