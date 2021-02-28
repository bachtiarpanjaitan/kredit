<?php

use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        District::truncate();

        $code = [];
        $regency_code = [];
        $name = [];

        $file = fopen(base_path('data/district.txt'), 'r');
        while (!feof($file)) {
            $baris = fgets($file);
            $array_data = explode(',',$baris);
            array_push($code, $array_data[0]);
            array_push($regency_code, $array_data[1]);
            array_push($name, $array_data[2]);
        }
        fclose($file);

        for ($i=0; $i < count($code); $i++) { 
            $district = new District();
            $district->code = $code[$i];
            $district->regency_code = $regency_code[$i];
            $district->name = $name[$i];
            $district->save();
        }
    }
}
