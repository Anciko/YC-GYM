<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;
    protected $fillable = ['workout_plan_id','member_type','workout_name','gender_type','time','calories','workout_level','workout_periods','place','day','image','video'];
}
