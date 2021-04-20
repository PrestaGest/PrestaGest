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
            $table->unsignedInteger('id_employee')->index('id_employee');
            $table->unsignedInteger('id_order')->index('order_history_order');
            $table->unsignedInteger('id_order_state');
            $table->dateTime('date_add');
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
        Schema::dropIfExists('order_histories');
    }
}
