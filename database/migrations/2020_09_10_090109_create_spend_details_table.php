<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpendDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spend_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('date');
            $table->unsignedInteger('spend_id');
            $table->string('spend_code');
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
        Schema::dropIfExists('spend_details');
    }
}
