<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =User::create([
            'name'=>'user',
            'email' =>'user@gmail.com',
            'phone'=>'0912345678',
            'password' => Hash::make('12345678'),
           ]);
        $user->assignRole('System_Admin');
    }
}
