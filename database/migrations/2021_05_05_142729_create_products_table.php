<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_manufacturer')->nullable();
            $table->Integer('id_supplier')->nullable();
            $table->integer('id_category_default')->nullable();
            $table->integer('id_manufacturer')->nullable();
            $table->string('new')->nullable();
            $table->integer('cache_default_attribute')->nullable();
            $table->unsignedBigInteger('id_default_image')->index();
            $table-unsignedBigInteger('id_default_combination')->index();
            $table->integer('id_tax_rules_group')->nullable();
            $table->integer('position_in_category')->nullable();
            $table->string('manufacturer_name')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('type')->nullable();
            $table->integer('id_shop_default')->nullable();
            $table->string('reference')->nullable();
            $table->string('supplier_reference')->nullable();
            $table->string('location')->nullable();
            $table->double('width' , 20, 6)->nullable()->default(0.000000);
            $table->double('height' , 20 , 6)->nullable()->default(0.000000);
            $table->double('depth', 20 , 6)->nullable()->default(0.000000);
            $table->double('weight' , 20 , 6)->nullable()->default(0.300000);
            $table->integer('quantity_discount')->nullable();
            $table->string('ean13')->nullable();
            $table->string('isbn')->nullable();
            $table->string('upc')->nullable();
            $table->string('mpn')->nullable();
            $table->integer('cache_is_pack')->nullable();
            $table->boolean('is_virtual')->nullable();
            $table->boolean('state')->nullable();
            $table->string('additional_delivery_times')->nullable();
            $table->string('delivery_in_stock')->nullable();
            $table->string('delivery_out_stock')->nullable();
            $table->boolean('on_sale')->nullable();
            $table->boolean('online_only')->nullable();
            $table->double('ecotax', 20 , 6)->nullable()->default(0.000000);
            $table->string('minimal_quantity')->nullable();
            $table->string('low_stock_threshold')->nullable();
            $table->string('low_stock_alert')->nullable();
            $table->double('price')->nullable()->default(0.000000);
            $table->string('additional_delivery_times')->nullable();
            $table->string('delivery_in_stock')->nullable();
            $table->string('delivery_out_stock')->nullable();
            $table->boolean('on_sale')->nullable();
            $table->boolean('online_only')->nullable();
            $table->string('manufacturer_name')->nullable();
            $table->string('mpn')->nullable();
            $table->integer('cache_is_pack')->nullable();
            $table->boolean('is_virtual')->nullable();
            $table->boolean('state')->nullable();
            $table->string('additional_delivery_times')->nullable();
            $table->string('delivery_in_stock')->nullable();
            $table->string('delivery_out_stock')->nullable();
            $table->boolean('on_sale')->nullable();
            $table->boolean('online_only')->nullable();
            $table->string('manufacturer_name')->nullable();
            $table->string('mpn')->nullable();
            $table->integer('cache_is_pack')->nullable();
            $table->boolean('is_virtual')->nullable();
            $table->boolean('state')->nullable();
            $table->string('additional_delivery_times')->nullable();
            $table->string('delivery_in_stock')->nullable();
            $table->string('delivery_out_stock')->nullable();
            $table->boolean('on_sale')->nullable();
            $table->boolean('online_only')->nullable();
            $table->string('manufacturer_name')->nullable();
            $table->string('mpn')->nullable();
            $table->integer('cache_is_pack')->nullable();
            $table->boolean('is_virtual')->nullable();
            $table->boolean('state')->nullable();
            $table->string('additional_delivery_times')->nullable();
            $table->string('delivery_in_stock')->nullable();
            $table->string('delivery_out_stock')->nullable();
            $table->boolean('on_sale')->nullable();
            $table->boolean('online_only')->nullable();
            $table->string('manufacturer_name')->nullable();

            // http://localhost/api/test/products
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
        Schema::dropIfExists('products');
    }
}
