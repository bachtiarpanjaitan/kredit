<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('brand_id');
            $table->tinyInteger('type_id');
            $table->tinyInteger('status')->default(1)->nullable();
            $table->string('code');
            $table->string('name');
            $table->string('model');
            $table->year('year');
            $table->string('color');
            $table->integer('cylinder');
            $table->double('price',15,2);
            $table->double('otr',15,2)->default(0)->nullable();
            $table->text('image')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
}
