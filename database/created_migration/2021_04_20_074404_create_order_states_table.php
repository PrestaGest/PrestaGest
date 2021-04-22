<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_states', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_order_state')->unique();
            $table->unsignedTinyInteger('invoice')->nullable()->default(0);
            $table->unsignedTinyInteger('send_email')->default(0);
            $table->string('module_name')->nullable()->index('module_name');
            $table->string('template')->nullable();
            $table->string('color', 32)->nullable();
            $table->string('name')->nullable();
            $table->unsignedTinyInteger('unremovable');
            $table->unsignedTinyInteger('hidden')->default(0);
            $table->boolean('logable')->default(0);
            $table->unsignedTinyInteger('delivery')->default(0);
            $table->unsignedTinyInteger('shipped')->default(0);
            $table->unsignedTinyInteger('paid')->default(0);
            $table->unsignedTinyInteger('pdf_invoice')->default(0);
            $table->unsignedTinyInteger('pdf_delivery')->default(0);
            $table->unsignedTinyInteger('deleted')->default(0);
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
        Schema::dropIfExists('order_states');
    }
}
