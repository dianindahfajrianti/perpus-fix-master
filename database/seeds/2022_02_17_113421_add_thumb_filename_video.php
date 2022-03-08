<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThumbFilenameVideo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('videos',function (Blueprint $t)
        {
            $t->string('desc')->nullable()->change();
            $t->string('filename')->after('desc');
            $t->string('thumb')->after('filetype')->nullable();
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
        Schema::table('videos',function (Blueprint $t)
        {
            $t->dropColumn('filename');
            $t->dropColumn('thumb');
            $t->string('desc')->nullable(false)->change();
            $t->tinyInteger('school_id')->after('clicked_time');
        });
    }
}
