<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('barcode');
            $table->string('product_name');
            $table->integer('product_brand');
            $table->integer('category_name');
            $table->integer('category_unit');
            $table->integer('subcategory');
            $table->integer('product_price');
            $table->string('sku');
            $table->integer('discount');
            $table->string('short_desp');
            $table->integer('p_sullier');
            $table->string('product_photo');
            $table->string('seo_tag');
            $table->longText('long_desp');
            $table->longText('add_info');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
