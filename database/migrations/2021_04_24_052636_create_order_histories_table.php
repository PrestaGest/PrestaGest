<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_order_history')->unique();
            $table->unsignedInteger('id_employee')->index('id_employee')->nullable();
            $table->unsignedInteger('id_order_state')->nullable();
            $table->unsignedInteger('id_order')->index('order_history_order');
            $table->dateTime('date_add');
            $table->timestamps();
        });
    }
    /*
      +"id": "12"
      +"id_employee": "0"
      +"id_order_state": "10"
      +"id_order": "7"
      +"date_add": "2021-05-02 06:52:26"
    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_histories');
    }
}
