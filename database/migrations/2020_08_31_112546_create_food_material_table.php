<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_material', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('food_id');
            $table->unsignedInteger('material_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('unit_id');
            $table->integer('satuan');
            $table->string('keterangan');
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
        Schema::dropIfExists('food_material');
    }
}
