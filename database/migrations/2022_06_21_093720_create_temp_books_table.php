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
            $table->string('jenjang',100)->nullable();
            $table->string('kelas',100)->nullable();
            $table->string('jurusan',100)->nullable();
            $table->string('mapel',100)->nullable();
            $table->string('nama_file')->nullable();
            $table->char('tipe_file',3)->nullable();
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
