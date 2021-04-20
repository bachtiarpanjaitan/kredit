<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function($table) {
            $table->string('npwp')->nullable();
            $table->integer('bank_id')->nullable();
            $table->string('rekening')->nullable();
            $table->text('slip_gaji')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function($table) {
            $table->dropColumn('npwp');
            $table->dropColumn('bank_id');
            $table->dropColumn('rekening');
            $table->dropColumn('slip_gaji');
        });
    }
}
