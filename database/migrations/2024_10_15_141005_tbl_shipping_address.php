<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_shipping_address', function (Blueprint $table) {
            $table->increments('id_shipping')->unsigned();
            $table->string('fullname');
            $table->string(column: 'order_phone');
            $table->string('matp');
            $table->string('maqh');
            $table->string('xaid');
            $table->string('diachi');
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
        Schema::dropIfExists('tbl_shipping_address');
    }
};
