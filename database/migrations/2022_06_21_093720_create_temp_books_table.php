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
            $table->char('judul',100)->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('th_terbit')->nullable();
            $table->string('penerbit',100)->nullable();
            $table->string('pengarang',100)->nullable();
            $table->integer('jenjang')->nullable();
            $table->integer('kelas')->nullable();
            $table->integer('jurusan')->nullable();
            $table->integer('mapel')->nullable();
            $table->string('filename')->nullable();
            $table->char('filetype',3)->nullable();
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
