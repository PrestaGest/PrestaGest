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
            $table->unsignedBigInteger('id_order_detail')->unique();
            $table->foreignId('id_order')->constrained('orders')->references('id_order')->nullable();
            $table->unsignedBigInteger('product_id')->unsigned();
            $table->unsignedBigInteger('product_attribute_id')->nullable();
            $table->unsignedInteger('product_quantity_reinjected')->nullable();
            $table->double('group_reduction', 3, 2)->default('0.00')->nullable();
            $table->unsignedInteger('discount_quantity_applied')->nullable();
            $table->string('download_hash')->nullable();
            $table->string('download_deadline')->nullable();
            $table->unsignedInteger('id_order_invoice')->nullable();
            $table->unsignedInteger('id_warehouse')->nullable();
            $table->unsignedInteger('id_shop')->nullable();
            $table->unsignedInteger('id_customization')->nullable();
            $table->string('product_name')->nullable();
            $table->unsignedInteger('product_quantity')->nullable();
            $table->unsignedInteger('product_quantity_in_stock')->nullable();
            $table->unsignedInteger('product_quantity_return')->nullable();
            $table->unsignedInteger('product_quantity_refunded')->nullable();
            $table->double('product_price', 20, 6)->default('0.000000')->nullable();
            $table->double('reduction_percent', 3, 2)->default('0.00')->nullable();
            $table->double('reduction_amount', 20, 6)->default('0.000000')->nullable();
            $table->double('reduction_amount_tax_incl', 20, 6)->default('0.000000')->nullable();
            $table->double('reduction_amount_tax_excl', 20, 6)->default('0.000000')->nullable();
            $table->double('product_quantity_discount', 20, 6)->default('0.000000')->nullable();
            $table->string('product_ean13')->nullable();
            $table->string('product_isbn')->nullable();
            $table->string('product_upc')->nullable();
            $table->string('product_mpn')->nullable();
            $table->string('product_reference')->nullable();
            $table->string('product_supplier_reference')->nullable();
            $table->double('product_weight', 20, 6)->default('0.000000')->nullable();
            $table->unsignedInteger('tax_computation_method')->nullable();
            $table->unsignedInteger('id_tax_rules_group')->nullable();
            $table->double('ecotax', 20, 6)->default('0.000000')->nullable();
            $table->double('ecotax_tax_rate', 20, 6)->default('0.000')->nullable();
            $table->unsignedInteger('download_nb')->nullable();
            $table->double('unit_price_tax_incl', 20, 6)->default('0.000000')->nullable();
            $table->double('unit_price_tax_excl', 20, 6)->default('0.000000')->nullable();
            $table->double('total_price_tax_incl', 20, 6)->default('0.000000')->nullable();
            $table->double('total_price_tax_excl', 20, 6)->default('0.000000')->nullable();
            $table->double('total_shipping_price_tax_excl', 20, 6)->default('0.000000')->nullable();
            $table->double('purchase_supplier_price', 20, 6)->default('0.000000')->nullable();
            $table->double('original_product_price', 20, 6)->default('0.000000')->nullable();
            $table->double('original_wholesale_price', 20, 6)->default('0.000000')->nullable();
            $table->double('total_refunded_tax_excl', 20, 6)->default('0.000000')->nullable();
            $table->double('total_refunded_tax_incl', 20, 6)->default('0.000000')->nullable();
            $table->unsignedInteger('tax')->nullable();
            $table->timestamps();

            $table->index('id_order_detail');
            $table->index('product_id');
            $table->index('id_order');
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
