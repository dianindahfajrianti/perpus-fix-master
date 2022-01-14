<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->char('title',100);
            $table->text('desc');
            $table->string('filename');
            $table->char('filetype',3);
            $table->bigInteger('clicked_time');
            $table->integer('school_id');
            $table->integer('edu_id');
            $table->integer('grade_id');
            $table->integer('major_id');
            $table->integer('sub_id');
            $table->integer('published_year');
            $table->string('publisher',100);
            $table->string('author',100);
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
        Schema::dropIfExists('books');
    }
}
