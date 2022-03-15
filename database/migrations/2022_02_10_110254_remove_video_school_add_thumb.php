<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveVideoSchoolAddThumb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('videos',function(Blueprint $t){
            $t->string('thumb')->after('filename')->nullable();
            $t->dropColumn('school_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('videos',function(Blueprint $t){
            $t->integer('school_id');
            $t->dropColumn('thumb');
        });
    }
}
