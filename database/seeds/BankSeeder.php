<?php

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::truncate();

        $label = [];
        $value = [];

        $file = file_get_contents(base_path("bank.txt"));
        $encode_file = json_decode($file);
        
        foreach ($encode_file as $key => $item) {
            $bank = new Bank();
            $bank->name = $item->label;
            $bank->value = $item->value;
            $bank->save();
        }
    }
}
