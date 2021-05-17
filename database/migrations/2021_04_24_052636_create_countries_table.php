<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_country')->unique();
            $table->integer('id_zone')->nullable();
            $table->integer('id_currency')->nullable();
            $table->string('call_prefix')->nullable();
            $table->string('iso_code')->nullable();
            $table->boolean('active')->nullable()->default(0);
            $table->boolean('contains_states')->nullable()->default(0);
            $table->boolean('need_identification_number')->nullable()->default(0);
            $table->boolean('need_zip_code')->nullable()->default(0);
            $table->string('zip_code_format')->nullable();
            $table->boolean('display_tax_label')->nullable()->default(0);
            $table->jsonb('name')->nullable();
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
        Schema::dropIfExists('countries');
    }
}
