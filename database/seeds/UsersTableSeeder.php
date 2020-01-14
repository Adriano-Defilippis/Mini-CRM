<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      User::create([
         'email' => 'admin@admin.com',
         'password' => bcrypt('password'),
         'email_verified_at' => now(),
         'remember_token' => Str::random(10),
     ]);

    }
}
