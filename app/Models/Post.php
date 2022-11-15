<?php

namespace App\Models;

use App\Models\Report;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory,SoftDeletes;

    public function report(){
        return $this->hasOne(Report::class);
    }
}
