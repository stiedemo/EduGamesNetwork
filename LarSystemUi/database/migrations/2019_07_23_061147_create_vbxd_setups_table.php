<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVbxdSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vbxd_setups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_ques')->unsigned();
            $table->string('sap_xep_tien');
            $table->timestamps();
            $table->foreign('id_ques')->references('id')->on('vbxd_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vbxd_setups');
    }
}
