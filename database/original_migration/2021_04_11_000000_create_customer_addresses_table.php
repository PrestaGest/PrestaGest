<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_address')->unique();
            $table->foreignId('id_customer')->constrained('customers')->references('id_customer')->nullable();
            $table->bigInteger('id_manufacturer')->unsigned()->nullable()->default(0);
            $table->bigInteger('id_supplier')->unsigned()->nullable()->default(0);
            $table->bigInteger('id_warehouse')->unsigned()->nullable()->default(0);
            $table->bigInteger('id_country')->unsigned()->nullable()->default(0);
            $table->bigInteger('id_state')->unsigned()->nullable()->default(0);
            $table->string('alias')->nullable();
            $table->string('company')->nullable();
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('other')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_mobile')->nullable();
            $table->string('dni')->nullable();
            $table->boolean('deleted')->default(0);
            $table->string('date_add')->nullable();
            $table->string('date_upd')->nullable();
            $table->timestamps();
            $table->index('id_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_addresses');
    }
}
