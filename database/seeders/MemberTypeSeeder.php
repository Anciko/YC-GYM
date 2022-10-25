<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::create([
            'member_type' =>'Free',
            'price'=>0,
            'duration'=>0,
            'role_id'=>4
           ]);

        Member::create([
        'member_type' =>'Platinum',
        'duration'=>1,
        'price'=>5000,
        'role_id'=>5
       ]);

       Member::create([
        'member_type' =>'Gold',
        'duration'=>1,
        'price'=>20000,
        'role_id'=>6
       ]);

       Member::create([
        'member_type' =>'Diamond',
        'duration'=>1,
        'price'=>40000,
        'role_id'=>7
       ]);

       Member::create([
        'member_type' =>'Ruby',
        'duration'=>1,
        'price'=>100000,
        'role_id'=>8
       ]);

       Member::create([
        'member_type' =>'Ruby Premium',
        'duration'=>1,
        'price'=>200000,
        'role_id'=>9
       ]);

    }
}
