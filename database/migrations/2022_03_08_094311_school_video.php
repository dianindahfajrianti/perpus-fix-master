<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SchoolVideo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_video', function (Blueprint $table) {
            $table->unsignedBigInteger('video_id');
            $table->unsignedBigInteger('school_id');

            $table->foreign('video_id')->references('id')->on('videos');
            $table->foreign('school_id')->references('id')->on('schools');
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
        Schema::dropIfExists('school_video');
    }
}
