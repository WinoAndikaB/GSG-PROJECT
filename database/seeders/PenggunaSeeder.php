<?php

namespace Database\Seeders;

use App\Models\user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name'=>'Diyu Ganteng',
                'email'=>'Diyuganteng@gmail.com',
                'password'=>bcrypt('1234'),
                'role'=>'user'
            ]
        ];
        foreach($userData as $key=> $val){
            user::create($val);
        }
    }
}
