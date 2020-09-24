<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('restore_id');
            $table->string('restore_code');
            $table->unsignedInteger('material_id');
            $table->unsignedInteger('unit_id');
            $table->unsignedInteger('user_id');
            $table->integer('jumlah')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('twos');
    }
}
