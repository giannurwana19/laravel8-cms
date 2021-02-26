<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('email', 'admin@gmail.com')->first();
        $user = User::where('email', 'user@gmail.com')->first();

        if(!$admin && !$user){
            User::create([
                'name' => 'admin',
                'role' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password')
            ]);

            User::create([
                'name' => 'user',
                'role' => 'writer',
                'email' => 'user@gmail.com',
                'password' => bcrypt('password')
            ]);
        }
    }
}
