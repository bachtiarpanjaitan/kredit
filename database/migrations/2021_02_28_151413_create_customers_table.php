<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->index()->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->tinyInteger('gender');
            $table->string('no_kk');
            $table->string('no_ktp')->unique();
            $table->text('address')->nullable();
            $table->bigInteger('village_id',15)->nullable();
            $table->integer('district_id')->nullable();
            $table->tinyInteger('regency_id')->nullable();
            $table->tinyInteger('province_id')->nullable();
            $table->string('email')->index()->unique();
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('profession')->nullable();

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
