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
            $table->id();
            $table->integer('service_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('subsubcategory_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('product_name');
            $table->string('slug')->unique();
            $table->string('product_code')->nullable();
            $table->text('product_short_detail')->nullable();
            $table->text('product_long_detail')->nullable();
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->string('product_color')->nullable();
            $table->string('product_size')->nullable();
            $table->string('product_quantity');
            $table->string('product_tags')->nullable();
            $table->string('product_capacity')->nullable();
            $table->string('product_material')->nullable();
            $table->string('manufacture')->nullable();
            $table->string('main_image');
            $table->integer('viewed')->default(1);
            $table->tinyInteger('return')->default(0);
            $table->tinyInteger('approved')->default(0);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('products');
    }
}
