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
        $user = new User();

        $user->name = 'jessi';
        $user->email = 'jessi@example.com';
        $user->password = bcrypt('password');
        $user->save();
    }
}
