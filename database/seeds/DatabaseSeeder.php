<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(AdminSeeder::class);
        $this->call(VehicleSeeder::class);
        // $this->call(ProvinceSeeder::class);
        // $this->call(RegencySeeder::class);
        // $this->call(DistrictSeeder::class);
        // $this->call(VillageSeeder::class);
        // $this->call(UserSeeder::class);
    }
}
