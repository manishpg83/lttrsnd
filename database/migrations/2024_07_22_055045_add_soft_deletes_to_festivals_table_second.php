<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToFestivalsTableSecond extends Migration
{
    public function up()
    {
        Schema::table('festivals', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('festivals', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}