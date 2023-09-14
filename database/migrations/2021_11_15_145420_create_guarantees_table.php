<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuaranteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guarantees', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable();
            $table->string('guarantee_name')->nullable();
            $table->string('guarantee_city')->nullable();
            $table->string('guarantee_address')->nullable();
            $table->string('guarantee_phone')->nullable();
            $table->string('guarantee_email')->nullable();
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
        Schema::dropIfExists('garantees');
    }
}
