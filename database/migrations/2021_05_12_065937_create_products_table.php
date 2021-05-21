<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_product')->unique();
            $table->unsignedInteger('id_supplier')->nullable()->index('product_supplier');
            $table->unsignedInteger('id_manufacturer')->nullable();
            $table->unsignedInteger('id_category_default')->nullable()->index('id_category_default');
            $table->unsignedInteger('id_shop_default')->default(1);
            $table->unsignedInteger('id_tax_rules_group');
            $table->unsignedTinyInteger('on_sale')->default(0);
            $table->unsignedTinyInteger('online_only')->default(0);
            $table->string('ean13', 13)->nullable();
            $table->string('isbn', 32)->nullable();
            $table->string('upc', 12)->nullable();
            $table->decimal('ecotax', 17, 6)->default(0.000000);
            $table->integer('quantity')->default(0);
            $table->unsignedInteger('minimal_quantity')->default(1);
            $table->string('low_stock_threshold')->nulable();
            $table->boolean('low_stock_alert')->default(0);
            $table->decimal('price', 20, 6)->default(0.000000);
            $table->decimal('wholesale_price', 20, 6)->default(0.000000);
            $table->string('unity')->nullable();
            $table->decimal('unit_price_ratio', 20, 6)->default(0.000000);
            $table->decimal('additional_shipping_cost', 20)->default(0.00);
            $table->string('reference', 64)->nullable();
            $table->string('supplier_reference', 64)->nullable();
            $table->string('location', 64)->nullable();
            $table->decimal('width', 20, 6)->default(0.000000);
            $table->decimal('height', 20, 6)->default(0.000000);
            $table->decimal('depth', 20, 6)->default(0.000000);
            $table->decimal('weight', 20, 6)->default(0.000000);
            $table->unsignedInteger('out_of_stock')->default(2);
            $table->unsignedTinyInteger('additional_delivery_times')->default(1);
            $table->boolean('quantity_discount')->nullable()->default(0);
            $table->tinyInteger('customizable')->default(0);
            $table->tinyInteger('uploadable_files')->default(0);
            $table->tinyInteger('text_fields')->default(0);
            $table->unsignedTinyInteger('active')->default(0);
            $table->enum('redirect_type', ['', '404', '301-product', '302-product', '301-category', '302-category'])->default('');
            $table->unsignedInteger('id_type_redirected')->default(0);
            $table->boolean('available_for_order')->default(1);
            $table->string('available_date')->nullable();
            $table->boolean('show_condition')->default(0);
            $table->enum('condition', ['new', 'used', 'refurbished'])->default('new')->nullable();
            $table->boolean('show_price')->default(1);
            $table->boolean('indexed')->default(0)->index('indexed');
            $table->enum('visibility', ['both', 'catalog', 'search', 'none'])->default('both');
            $table->boolean('cache_is_pack')->default(0);
            $table->boolean('cache_has_attachments')->default(0);
            $table->boolean('is_virtual')->default(0);
            $table->unsignedInteger('cache_default_attribute')->nullable();
            $table->dateTime('date_add')->index('date_add');
            $table->dateTime('date_upd');
            $table->boolean('advanced_stock_management')->default(0);
            $table->unsignedInteger('pack_stock_type')->default(3);
            $table->unsignedInteger('state')->default(1);
            $table->index(['id_manufacturer', 'id_product'], 'product_manufacturer');
            $table->index(['state', 'date_upd'], 'state');

            // new
            $table->jsonb('associations')->nullable();
            $table->jsonb('available_later')->nullable();
            $table->jsonb('available_now')->nullable();
            $table->jsonb('delivery_in_stock')->nullable();
            $table->jsonb('delivery_out_stock')->nullable();
            $table->jsonb('description')->nullable();
            $table->jsonb('description_short')->nullable();
            $table->jsonb('link_rewrite')->nullable();
            $table->string('manufacturer_name')->nullable();
            $table->jsonb('meta_description')->nullable();
            $table->jsonb('meta_keywords')->nullable();
            $table->jsonb('meta_title')->nullable();
            $table->string('mpn')->nullable();
            $table->jsonb('name')->nullable();
            $table->string('type')->nullable();
            $table->string('id_default_combination')->nullable();
            $table->string('id_default_image')->nullable();
            $table->string('new')->nullable();
            $table->unsignedInteger('position_in_category')->default(1);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
