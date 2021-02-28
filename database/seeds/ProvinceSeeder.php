<?php

use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::truncate();

        $code = [];
        $name = [];

        $file = fopen(base_path('data/province.txt'), 'r');
        while (!feof($file)) {
            $baris = fgets($file);
            $array_data = explode(',',$baris);
            array_push($code, $array_data[0]);
            array_push($name, $array_data[1]);
        }
        fclose($file);

        for ($i=0; $i < count($code); $i++) { 
            $province = new Province();
            $province->code = $code[$i];
            $province->name = $name[$i];
            $province->save();
        }
    }
}
