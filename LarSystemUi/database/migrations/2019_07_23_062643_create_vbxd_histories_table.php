<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVbxdHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vbxd_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_history')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->integer('id_ques')->unsigned();
            $table->integer('id_game')->unsigned();
            $table->integer('id_setup')->unsigned();
            $table->string('cau_tra_loi');
            $table->string('cac_muc_tien');
            $table->string('cac_goi_y');
            $table->string('so_tien_truoc');
            $table->timestamps();
            $table->foreign('id_history')->references('id')->on('histories');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_ques')->references('id')->on('vbxd_questions');
            $table->foreign('id_game')->references('id')->on('games');
            $table->foreign('id_setup')->references('id')->on('vbxd_setups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vbxd_histories');
    }
}
