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
        Schema::connection('sqlsrv_server2')->create('GZ_DETAIL_MAKANAN', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('food_id');
            $table->unsignedInteger('material_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('unit_id');
            $table->integer('jumlah');
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
        Schema::connection('sqlsrv_server2')->dropIfExists('GZ_DETAIL_MAKANAN');
    }
}
