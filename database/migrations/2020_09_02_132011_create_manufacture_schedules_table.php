<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManufactureSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufacture_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->integer('line');
            $table->dateTime('start');
            $table->dateTime('finish');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('surface_id');
            $table->unsignedBigInteger('color_id');
            $table->string('sizes');
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('manufacture_schedules');
    }
}
