<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('id_order_detail')->unique();
            $table->foreignId('order_id')->constrained()->nullable();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('product_attribute_id')->unsigned();
            $table->integer('product_quantity')->unsigned()->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_reference')->nullable();
            $table->string('product_ean13')->nullable();
            $table->string('product_isbn')->nullable();
            $table->string('product_upc')->nullable();
            $table->double('product_price', 20, 6)->default('0.000000')->nullable();
            $table->integer('id_customization')->unsigned()->nullable();;
            $table->double('unit_price_tax_incl', 20, 6)->default('0.000000')->nullable();
            $table->double('unit_price_tax_excl', 20, 6)->default('0.000000')->nullable();
            $table->timestamps();
            // $table->index('id_order_detail');
            $table->index('product_id');
            $table->index('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
