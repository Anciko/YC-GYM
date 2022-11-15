<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    public function post_report(){
        return $this->belongsTo(Post::class);
    }

    public function comment_report(){
        return $this->belongsTo(Comment::class);
    }
}


