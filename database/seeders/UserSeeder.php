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

        $user =User::create([
            'name'=>'trainer',
            'email' =>'trainer@gmail.com',
            'phone'=>'09123456789',
            'password' => Hash::make('12345678'),
           ]);
        $user->assignRole('Trainer');
    }
}
