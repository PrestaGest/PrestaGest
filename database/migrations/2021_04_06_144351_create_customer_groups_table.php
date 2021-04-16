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
            $table->id();
            $table->unsignedBigInteger('id_group')->nullable();
            $table->double('reduction', 3, 2)->default('0.00')->nullable();
            $table->boolean('price_display_method')->default(0);
            $table->boolean('show_prices')->default(1);
            $table->datetime('date_add')->nullable();
            $table->datetime('date_upd')->nullable();
            $table->string('name')->nullable();
            $table->timestamps();
            $table->index('id_group');
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
