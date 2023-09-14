<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->boolean('service')->nullable();
            $table->boolean('post')->nullable();
            $table->boolean('category')->nullable();
            $table->boolean('subcategory')->nullable();
            $table->boolean('product')->nullable();
            $table->boolean('brand')->nullable();
            $table->boolean('coupon')->nullable();
            $table->boolean('order')->nullable();
            $table->boolean('user')->nullable();
            $table->boolean('report')->nullable();
            $table->boolean('setting')->nullable();
            $table->boolean('stock')->nullable();
            $table->boolean('role')->nullable();
            $table->boolean('gallery')->nullable();
            $table->boolean('employee')->nullable();
            $table->boolean('subscriber')->nullable();
            $table->boolean('slider')->nullable();
            $table->boolean('advs')->nullable();
            $table->boolean('message')->nullable();
            $table->boolean('comment')->nullable();
            $table->boolean('review')->nullable();
            $table->boolean('company')->nullable();
            $table->boolean('type')->nullable();


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
        Schema::dropIfExists('permissions');
    }
}
