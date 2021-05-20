<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManufactureProductTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufacture_product_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('product_id')->constrained('manufacture_products');
            $table->foreignId('size_id')->constrained('manufacture_sizes');
            $table->foreignId('color_id')->constrained('manufacture_colors');
            $table->foreignId('surface_id')->constrained('manufacture_surfaces');
            $table->foreignId('weight_id')->constrained('manufacture_weights');
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
        Schema::dropIfExists('manufacture_product_types');
    }
}
