<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->char('title');
            $table->text('desc')->nullable();
            $table->string('filename');
            $table->char('filetype',3);
            $table->string('thumb')->nullable();
            $table->bigInteger('clicked_time');
            $table->integer('edu_id')->nullable(false);
            $table->integer('grade_id')->nullable(false)->default(0);
            $table->integer('major_id')->nullable(false)->default(0);
            $table->integer('sub_id')->nullable(false)->default(0);
            $table->string('creator');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
