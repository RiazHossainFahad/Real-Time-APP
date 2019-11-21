<?php

namespace App;

use App\User;
use App\Reply;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**For mass assignment */
    protected $guarded = [];

    /**By default route @param is id
     * Now set to "slug"
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reply()
    {
        return $this->hasMany(Reply::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**Actual PATH for the question like domain/api/question/slug */
    public function getPathAttribute()
    {
        return asset("api/question/$this->slug");
    }
}