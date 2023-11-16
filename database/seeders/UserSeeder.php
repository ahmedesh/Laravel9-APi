<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'ahmed',
            'email' => 'ahmedesh88@gmail.com',
            'password' => bcrypt('ahmed@12'),
        ]);
    }
}
