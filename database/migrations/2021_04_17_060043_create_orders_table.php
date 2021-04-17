<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_order')->unique();
            $table->string('reference')->nullable()->index();
            $table->unsignedBigInteger('id_shop_group')->nullable()->index();
            $table->unsignedBigInteger('id_shop')->nullable()->index();
            $table->unsignedBigInteger('id_carrier')->nullable()->index();
            $table->unsignedBigInteger('id_lang')->nullable()->index();
            $table->unsignedBigInteger('id_customer')->index();
            $table->unsignedBigInteger('id_cart')->nullable()->index();
            $table->unsignedBigInteger('id_currency')->nullable()->index();
            $table->unsignedBigInteger('id_address_delivery')->index();
            $table->unsignedBigInteger('id_address_invoice')->index();
            $table->unsignedBigInteger('current_state')->nullable()->index();
            $table->string('secure_key')->nullable();
            $table->string('payment')->nullable();
            $table->double('conversion_rate', 20, 6)->nullable()->default(1.000000);
            $table->string('module')->nullable();
            $table->unsignedTinyInteger('recyclable')->default(0);
            $table->unsignedTinyInteger('gift')->default(0);
            $table->string('gift_message')->nullable();
            $table->unsignedTinyInteger('mobile_theme')->default(0);
            $table->string('shipping_number')->nullable();
            $table->double('total_discounts', 20, 6)->nullable()->default(0.000000);
            $table->double('total_discounts_tax_incl', 20, 6)->nullable()->default(0.000000);
            $table->double('total_discounts_tax_excl', 20, 6)->nullable()->default(0.000000);
            $table->double('total_paid', 20, 6)->nullable()->default(0.000000);
            $table->double('total_paid_real', 20, 6)->nullable()->default(0.000000);
            $table->double('total_paid_tax_incl', 20, 6)->nullable()->default(0.000000);
            $table->double('total_paid_tax_excl', 20, 6)->nullable()->default(0.000000);
            $table->double('total_paid_tax_real', 20, 6)->nullable()->default(0.000000);
            $table->double('total_products', 20, 6)->nullable()->default(0.000000);
            $table->double('total_products_wt', 20, 6)->nullable()->default(0.000000);
            $table->double('total_shipping', 20, 6)->nullable()->default(0.000000);
            $table->double('total_shipping_tax_incl', 20, 6)->nullable()->default(0.000000);
            $table->double('total_shipping_tax_excl', 20, 6)->nullable()->default(0.000000);
            $table->double('carrier_tax_rate', 20, 6)->nullable()->default(0.000000);
            $table->double('total_wrapping', 20, 6)->nullable()->default(0.000000);
            $table->double('total_wrapping_tax_incl', 20, 6)->nullable()->default(0.000000);
            $table->double('total_wrapping_tax_excl', 20, 6)->nullable()->default(0.000000);
            $table->unsignedTinyInteger('round_mode')->default(0);
            $table->unsignedTinyInteger('round_type')->default(0);
            $table->integer('invoice_number')->nullable()->default(0)->index();
            $table->integer('delivery_number')->nullable()->default(0);
            $table->string('delivery_date')->nullable();
            $table->string('invoice_date')->nullable();
            $table->boolean('valid')->nullable()->default(0);
            $table->string('associations')->nullable();
            $table->dateTime('date_add')->nullable()->index();
            $table->dateTime('date_upd')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
