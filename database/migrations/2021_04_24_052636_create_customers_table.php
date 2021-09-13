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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_customer')->unique()->nullable();
            $table->unsignedBigInteger('id_shop_group')->default(1)->index();
            $table->unsignedBigInteger('id_shop')->default(1)->index();
            $table->unsignedBigInteger('id_gender')->nullable()->index();
            $table->unsignedBigInteger('id_default_group')->default(3)->nullable()->index();
            $table->unsignedBigInteger('id_lang')->nullable()->default(1);
            $table->unsignedInteger('id_risk')->nullable();
            $table->string('company')->nullable();
            $table->string('siret')->nullable();
            $table->string('ape')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->nullable();
            $table->string('passwd')->nullable();
            $table->string('last_passwd_gen')->nullable();
            $table->string('birthday')->nullable();
            $table->boolean('newsletter')->nullable()->default(0);
            $table->string('ip_registration_newsletter')->nullable();
            $table->string('newsletter_date_add')->nullable();
            $table->boolean('optin')->nullable()->default(0);
            $table->string('website')->nullable();
            $table->double('outstanding_allow_amount', 8, 2)->nullable();
            $table->boolean('show_public_prices')->nullable()->default(0);
            $table->unsignedInteger('max_payment_days')->nullable();
            $table->string('secure_key')->nullable();
            $table->string('note')->nullable();
            $table->boolean('active')->nullable()->default(0);
            $table->boolean('is_guest')->nullable()->default(0);
            $table->boolean('deleted')->nullable()->default(0);
            $table->timestamp('date_upd')->nullable();
            $table->timestamp('date_add')->nullable();
            $table->string('reset_password_token')->nullable();
            $table->string('reset_password_validity')->nullable();
            $table->jsonb('associations')->nullable();
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
