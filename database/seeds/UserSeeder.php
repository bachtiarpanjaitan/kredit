<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $admin = new User();
        $admin->name = "User Testing";
        $admin->email = "user@user.com";
        $admin->password = bcrypt('user1234');
        $admin->save();
    }
}
