<?php

namespace App\Http\Resources;

use App\Http\Resources\ReplyResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'path' => $this->path,
            'body' => $this->body,
            'created_at' => $this->created_at->diffForhumans(),
            'user' => $this->user->name,
            'user_id' => $this->user->id,
            'reply' => ReplyResource::collection($this->reply),
            'reply_count' => $this->reply()->count(),
        ];
    }
}