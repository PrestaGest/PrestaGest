<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_order_payment')->unique();
            $table->string('order_reference', 9)->nullable()->index('order_reference');
            $table->unsignedInteger('id_currency');
            $table->decimal('amount', 20, 6);
            $table->string('payment_method');
            $table->decimal('conversion_rate', 13, 6)->default(1.000000);
            $table->string('transaction_id', 254)->nullable();
            $table->string('card_number', 254)->nullable();
            $table->string('card_brand', 254)->nullable();
            $table->char('card_expiration', 7)->nullable();
            $table->string('card_holder', 254)->nullable();
            $table->dateTime('date_add');
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
        Schema::dropIfExists('order_payments');
    }
}
