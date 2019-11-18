<?php

namespace App;

use App\Like;
use App\User;
use App\Question;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function like(){
        return $this->hasMany(Like::class);
    }
}
