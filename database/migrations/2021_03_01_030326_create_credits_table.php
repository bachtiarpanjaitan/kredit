<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id')->index();
            $table->tinyInteger('interest_type')->default(1);
            $table->double('interest',15,2)->default(0);
            $table->double('down_payment',15,2);
            $table->integer('tenor')->default(12);
            $table->double('price',15,2)->default(0);
            $table->tinyInteger('vehicle_id')->index();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credits');
    }
}
