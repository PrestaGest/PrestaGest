<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer')->unique();
            $table->bigInteger('id_shop_group')->unsigned()->default(1);
            $table->bigInteger('id_shop')->unsigned()->default(1);
            $table->bigInteger('id_gender')->unsigned()->nullable();
            $table->foreignId('id_default_group')->constrained('customer_groups')->references('id_group')->nullable();
            $table->bigInteger('id_lang')->unsigned()->nullable();
            $table->integer('id_risk')->unsigned()->nullable();
            $table->string('company')->nullable();
            $table->string('siret')->nullable();
            $table->string('ape')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->nullable();
            $table->string('passwd')->nullable();
            $table->string('last_passwd_gen')->nullable();
            $table->string('birthday')->nullable();
            $table->boolean('newsletter')->default(0)->nullable();
            $table->string('ip_registration_newsletter')->nullable();
            $table->string('newsletter_date_add')->nullable();
            $table->boolean('optin')->default(0)->nullable();
            $table->string('website')->nullable();
            $table->float('outstanding_allow_amount')->nullable();
            $table->boolean('show_public_prices')->nullable()->default(0);
            $table->integer('max_payment_days')->unsigned()->nullable();
            $table->string('secure_key')->nullable();
            $table->string('note')->nullable();
            $table->boolean('active')->nullable()->default(0);
            $table->boolean('is_guest')->nullable()->default(0);
            $table->boolean('deleted')->nullable()->default(0);
            $table->datetime('date_add')->nullable();
            $table->datetime('date_upd')->nullable();
            $table->string('reset_password_token')->nullable();
            $table->string('reset_password_validity')->nullable();
            $table->string('associations')->nullable();
            $table->timestamps();
            $table->index('id_customer');
            $table->index('id_gender');
            $table->index('id_shop_group');
            $table->index('id_default_group');
            $table->index('id_shop');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
