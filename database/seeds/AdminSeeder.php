<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Admin::truncate();

        $admin = new Admin();
        $admin->name = "Admin";
        $admin->email = "admin@admin.com";
        $admin->password = bcrypt('admin1234');
        $admin->save();
    }
}
