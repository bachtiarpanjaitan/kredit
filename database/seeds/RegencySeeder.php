<?php

use Illuminate\Database\Seeder;
use App\Models\Regency;

class RegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Regency::truncate();
       $province_code = [];
       $code = [];
       $name = [];

       $file = fopen(base_path('data/regency.txt'), 'r');
       while (!feof($file)) {
           $baris = fgets($file);
           $array_data = explode(',',$baris);
           array_push($code, $array_data[0]);
           array_push($province_code, $array_data[1]);
           array_push($name, $array_data[2]);
       }
       fclose($file);

       for ($i=0; $i < count($code); $i++) { 
           $regency = new Regency();
           $regency->code = $code[$i];
           $regency->province_code = $province_code[$i];
           $regency->name = $name[$i];
           $regency->save();
       }
    }
}
