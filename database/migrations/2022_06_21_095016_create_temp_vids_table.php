<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempVidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_vids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('judul')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('nama_pembuat')->nullable();
            $table->string('thumbnail',8)->nullable();
            $table->string('jenjang')->nullable();
            $table->string('kelas')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('mapel')->nullable();
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
        Schema::dropIfExists('temp_vids');
    }
}
