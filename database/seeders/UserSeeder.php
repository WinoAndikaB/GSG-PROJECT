<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        // Data Superadmin
        User::create([
            'username' => 'superadmin',
            'name' => 'Superadmin 1',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('123'),
            'alamat'  => 'Jl. Hololive Satu',
            'instagram' => 'https://www.instagram.com/moonahoshinova/',
            'facebook' => 'https://www.facebook.com/moonahoshinova/',
            'aboutme' => 'Moon Moon Dayo',
            'role' => 'superadmin',
        ]);
    }
}
