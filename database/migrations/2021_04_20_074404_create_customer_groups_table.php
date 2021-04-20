<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_group')->unique();
            $table->double('reduction', 3, 2)->nullable()->default(0.00);
            $table->boolean('price_display_method')->default(0);
            $table->boolean('show_prices')->default(1);
            $table->dateTime('date_add')->nullable();
            $table->dateTime('date_upd')->nullable();
            $table->string('name')->nullable();
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
        Schema::dropIfExists('customer_groups');
    }
}
