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
            $table->id();
            $table->unsignedBigInteger('id_order')->unique();
            $table->string('reference')->nullable();
            $table->bigInteger('id_shop_group')->unsigned()->nullable();
            $table->bigInteger('id_shop')->unsigned()->nullable();
            $table->bigInteger('id_carrier')->unsigned()->nullable();
            $table->bigInteger('id_lang')->unsigned()->nullable();
            $table->foreignId('id_customer')->constrained('customers')->references('id_customer')->nullable();
            $table->bigInteger('id_cart')->unsigned()->nullable();
            $table->bigInteger('id_currency')->unsigned()->nullable();
            $table->foreignId('id_address_delivery')->constrained('customer_addresses')->references('id_address')->nullable();
            $table->foreignId('id_address_invoice')->constrained('customer_addresses')->references('id_address')->nullable();
            $table->bigInteger('current_state')->unsigned()->nullable();
            $table->string('secure_key')->nullable();
            $table->string('payment')->nullable();
            $table->double('conversion_rate', 20, 6)->default('1.000000')->nullable();
            $table->string('module')->nullable();
            $table->boolean('recyclable')->unsigned()->default(0);
            $table->boolean('gift')->unsigned()->default(0);
            $table->string('gift_message')->nullable();
            $table->boolean('mobile_theme')->unsigned()->default(0);
            $table->string('shipping_number')->nullable();
            $table->double('total_discounts', 20, 6)->default('0.000000')->nullable();
            $table->double('total_discounts_tax_incl', 20, 6)->default('0.000000')->nullable();
            $table->double('total_discounts_tax_excl', 20, 6)->default('0.000000')->nullable();
            $table->double('total_paid', 20, 6)->default('0.000000')->nullable();
            $table->double('total_paid_real', 20, 6)->default('0.000000')->nullable();
            $table->double('total_paid_tax_incl', 20, 6)->default('0.000000')->nullable();
            $table->double('total_paid_tax_excl', 20, 6)->default('0.000000')->nullable();
            $table->double('total_paid_tax_real', 20, 6)->default('0.000000')->nullable();
            $table->double('total_products', 20, 6)->default('0.000000')->nullable();
            $table->double('total_products_wt', 20, 6)->default('0.000000')->nullable();
            $table->double('total_shipping', 20, 6)->default('0.000000')->nullable();
            $table->double('total_shipping_tax_incl', 20, 6)->default('0.000000')->nullable();
            $table->double('total_shipping_tax_excl', 20, 6)->default('0.000000')->nullable();
            $table->double('carrier_tax_rate', 20, 6)->default('0.000000')->nullable();
            $table->double('total_wrapping', 20, 6)->default('0.000000')->nullable();
            $table->double('total_wrapping_tax_incl', 20, 6)->default('0.000000')->nullable();
            $table->double('total_wrapping_tax_excl', 20, 6)->default('0.000000')->nullable();
            $table->boolean('round_mode')->unsigned()->default(0);
            $table->boolean('round_type')->unsigned()->default(0);
            $table->integer('invoice_number')->default('0')->nullable();
            $table->integer('delivery_number')->default('0')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('invoice_date')->nullable();
            $table->boolean('valid')->default('0')->nullable();
            $table->string('associations')->nullable();
            $table->datetime('date_add')->nullable();
            $table->datetime('date_upd')->nullable();
            $table->timestamps();
            $table->index('id_order');
            $table->index('reference');
            $table->index('id_customer');
            $table->index('id_cart');
            $table->index('invoice_number');
            $table->index('id_carrier');
            $table->index('id_lang');
            $table->index('id_currency');
            $table->index('id_address_delivery');
            $table->index('id_address_invoice');
            $table->index('id_shop_group');
            $table->index('current_state');
            $table->index('id_shop');
            $table->index('date_add');
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
