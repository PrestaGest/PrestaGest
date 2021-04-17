<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('id_address_delivery')->references('id_address')->on('customer_addresses')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign('id_address_invoice')->references('id_address')->on('customer_addresses')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign('id_customer')->references('id_customer')->on('customers')->onUpdate('CASCADE')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_id_address_delivery_foreign');
            $table->dropForeign('orders_id_address_invoice_foreign');
            $table->dropForeign('orders_id_customer_foreign');
        });
    }
}
