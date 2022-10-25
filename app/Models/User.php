<?php

namespace App\Models;

use App\Models\Payment;
use App\Models\TrainingGroup;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,HasRoles, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // public function member_histories()
    // {
    //     return $this->hasMany(MemberHistory::class);
    // }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_histories')
                    ->withPivot(['member_id','member_type_level','deleted_at'])
                    ->withTimestamps();
    }

    public function tainer_groups()
    {
        return $this->belongsToMany(TrainingGroup::class,'training_users')
                    // ->withPivot(['user_id','training_group_id'])
                    ->withTimestamps();
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }


//   public function member()
//   {
//       return $this->hasOne(User::class);
//   }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $guarded = [];
}
