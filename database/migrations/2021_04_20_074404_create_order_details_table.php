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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_order_detail')->unique();
            $table->unsignedBigInteger('id_order')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedBigInteger('product_attribute_id')->nullable();
            $table->integer('product_quantity_reinjected')->nullable();
            $table->double('group_reduction', 3, 2)->nullable()->default(0.00);
            $table->integer('discount_quantity_applied')->nullable();
            $table->string('download_hash')->nullable();
            $table->string('download_deadline')->nullable();
            $table->integer('id_order_invoice')->nullable();
            $table->integer('id_warehouse')->nullable();
            $table->integer('id_shop')->nullable();
            $table->integer('id_customization')->nullable();
            $table->string('product_name')->nullable();
            $table->integer('product_quantity')->nullable();
            $table->double('product_quantity_in_stock', 20, 6)->nullable();
            $table->double('product_quantity_return', 20, 6)->nullable();
            $table->double('product_quantity_refunded', 20, 6)->nullable();
            $table->double('product_price', 20, 6)->nullable()->default(0.000000);
            $table->double('reduction_percent', 3, 2)->nullable()->default(0.00);
            $table->double('reduction_amount', 20, 6)->nullable()->default(0.000000);
            $table->double('reduction_amount_tax_incl', 20, 6)->nullable()->default(0.000000);
            $table->double('reduction_amount_tax_excl', 20, 6)->nullable()->default(0.000000);
            $table->double('product_quantity_discount', 20, 6)->nullable()->default(0.000000);
            $table->string('product_ean13')->nullable();
            $table->string('product_isbn')->nullable();
            $table->string('product_upc')->nullable();
            $table->string('product_mpn')->nullable();
            $table->string('product_reference')->nullable();
            $table->string('product_supplier_reference')->nullable();
            $table->double('product_weight', 20, 6)->nullable()->default(0.000000);
            $table->integer('tax_computation_method')->nullable();
            $table->integer('id_tax_rules_group')->nullable();
            $table->double('ecotax', 20, 6)->nullable()->default(0.000000);
            $table->double('ecotax_tax_rate', 20, 6)->nullable()->default(0.000000);
            $table->integer('download_nb')->nullable();
            $table->double('unit_price_tax_incl', 20, 6)->nullable()->default(0.000000);
            $table->double('unit_price_tax_excl', 20, 6)->nullable()->default(0.000000);
            $table->double('total_price_tax_incl', 20, 6)->nullable()->default(0.000000);
            $table->double('total_price_tax_excl', 20, 6)->nullable()->default(0.000000);
            $table->double('total_shipping_price_tax_incl', 20, 6)->nullable()->default(0.000000);
            $table->double('total_shipping_price_tax_excl', 20, 6)->nullable()->default(0.000000);
            $table->double('purchase_supplier_price', 20, 6)->nullable()->default(0.000000);
            $table->double('original_product_price', 20, 6)->nullable()->default(0.000000);
            $table->double('original_wholesale_price', 20, 6)->nullable()->default(0.000000);
            $table->double('total_refunded_tax_excl', 20, 6)->nullable()->default(0.000000);
            $table->double('total_refunded_tax_incl', 20, 6)->nullable()->default(0.000000);
            // $table->unsignedInteger('tax')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
