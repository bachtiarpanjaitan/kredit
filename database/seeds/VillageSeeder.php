<?php

use Illuminate\Database\Seeder;
use App\Models\Village;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Village::truncate();

         $code = [];
         $district_code = [];
         $name = [];

         $file = fopen(base_path('data/village.txt'), 'r');
         while (!feof($file)) {
             $baris = fgets($file);
             $array_data = explode(',',$baris);
             array_push($code, $array_data[0]);
             array_push($district_code, $array_data[1]);
             array_push($name, $array_data[2]);
         }
         fclose($file);

         for ($i=0; $i < count($code); $i++) { 
             $village = new Village();
             $village->code = $code[$i];
             $village->district_code = $district_code[$i];
             $village->name = $name[$i];
             $village->save();
         }
    }
}
