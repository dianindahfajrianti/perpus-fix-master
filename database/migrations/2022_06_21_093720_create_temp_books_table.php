<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('title',100)->nullable();
            $table->text('desc')->nullable();
            $table->string('filename')->nullable();
            $table->char('filetype',3)->nullable();
            $table->integer('edu_id')->nullable();
            $table->integer('grade_id')->nullable();
            $table->integer('major_id')->nullable();
            $table->integer('sub_id')->nullable();
            $table->integer('published_year')->nullable();
            $table->string('publisher',100)->nullable();
            $table->string('author',100)->nullable();
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
        Schema::dropIfExists('temp_books');
    }
}
