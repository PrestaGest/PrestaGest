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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_address')->unique();
            $table->unsignedBigInteger('id_customer')->index('customer_addresses_id_customer_foreign');
            $table->unsignedBigInteger('id_manufacturer')->nullable()->default(0);
            $table->unsignedBigInteger('id_supplier')->nullable()->default(0);
            $table->unsignedBigInteger('id_warehouse')->nullable()->default(0);
            $table->unsignedBigInteger('id_country')->nullable()->default(0);
            $table->unsignedBigInteger('id_state')->nullable()->default(0);
            $table->string('alias')->nullable();
            $table->string('company')->nullable();
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->longText('other')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_mobile')->nullable();
            $table->string('dni')->nullable();
            $table->boolean('deleted')->default(0);
            $table->string('date_add')->nullable();
            $table->string('date_upd')->nullable();
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
        Schema::dropIfExists('customer_addresses');
    }
}
