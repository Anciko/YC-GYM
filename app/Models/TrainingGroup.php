<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingGroup extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class,'training_users')
                    //->withPivot(['user_id','training_group_id'])
                    ->withTimestamps();
    }

    public function user() {
        return $this->belongsTo(User::class,'trainer_id','id');
    }
}
