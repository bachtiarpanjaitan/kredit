<?php

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehicle::truncate();

        $v = [
        	'brand_id' => 1,
        	'type_id' => 1,
        	'code' => 'OIHOUBOP56B',
        	'name' => 'Supra X 125D',
        	'model' => 'IYUO7777',
        	'year' => 2018,
        	'color' => 'GREEN',
        	'cylinder' => 125
        ];

        Vehicle::insert($v);

        $v = [
        	'brand_id' => 1,
        	'type_id' => 2,
        	'code' => '879JJO99',
        	'name' => 'MIO SOUL G',
        	'model' => '0987NI867NUI',
        	'year' => 2015,
        	'color' => 'YELLOW',
        	'cylinder' => 110
        ];

        Vehicle::insert($v);

    }
}
