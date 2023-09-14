<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name')->nullable();
            $table->string('email')->nullable();
            $table->text('phone')->nullable();
            $table->test('address')->nullable();
            $table->string('logo_dark')->nullable();
            $table->string('logo_light')->nullable();
            $table->string('favicon')->nullable();
            $table->integer('employees')->nullable()->default(0);
            $table->integer('products')->nullable()->default(0);
            $table->integer('clients')->nullable()->default(0);
            $table->integer('branches')->nullable()->default(0);
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('whatsup')->nullable();
            $table->string('youtube')->nullable();
            $table->string('vat')->nullable();
            $table->string('shipping_charge')->nullable();
            $table->string('city_shipping')->nullable();
            $table->timestamp('deal_timer')->nullable();


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
        Schema::dropIfExists('settings');
    }
}
