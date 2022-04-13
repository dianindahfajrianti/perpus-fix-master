<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('username',11)->unique();
            $table->string('email')->unique();
            $table->string('role');
            $table->string('sekolah')->nullable();
            $table->string('kelas')->nullable();
            $table->string('jurusan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temps');
    }
}
