<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory,SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user_reacted_posts()
    {
        return $this->hasMany(UserReactPost::class, 'post_id', 'id');
    }

    public function user_saved_posts()
    {
        return $this->hasMany(UserSavedPost::class, 'post_id', 'id');
    }
}
