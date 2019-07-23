<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVbxdQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vbxd_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user_created')->unsigned();
            $table->integer('id_bigques')->unsigned();
            $table->integer('id_game')->unsigned();
            # Free_help: Gợi ý miễn phí: Giải thích
            $table->string('free_help');
            # Help: 9 Gợi ý sắp xếp theo thứ tự từ 1 đến 9
            $table->string('help');
            # Help: 9 lượng tiền để mua gợi ý : Sẽ quy định không được vượt quá bao nhiêu đó.
            $table->string('many');
            # Giải thích: 9 lời giải thích tương ứng
            $table->string('gt_help')->nullable();
            $table->string('dap_an');
            $table->integer('luot_choi');
            $table->timestamps();
            $table->foreign('id_bigques')->references('id')->on('vbxd_big_questions');
            $table->foreign('id_user_created')->references('id')->on('users');
            $table->foreign('id_game')->references('id')->on('games');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vbxd_questions');
    }
}
