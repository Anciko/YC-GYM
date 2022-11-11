<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberHistory extends Model
{
    use HasFactory;
    protected $guraded=[];    // protected $fillable = ['user_id','to_member_id','member_type_level'];
}
