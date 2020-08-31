<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::truncate();

        $user = User::create([
           'name' => 'admin',
           'email' => 'admin@mail.com',
           'password' => \Illuminate\Support\Facades\Hash::make('asd'),
        ]);

        $user->roles()->attach(1);
    }
}
