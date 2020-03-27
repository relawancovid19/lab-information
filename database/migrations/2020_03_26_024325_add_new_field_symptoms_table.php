<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldSymptomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('symptoms', function (Blueprint $table) {
            $table->string('xray_result')->nullable();
            $table->string('leukosit')->nullable();
            $table->string('limfosit')->nullable();
            $table->string('trombosit')->nullable();
            $table->tinyInteger('health_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('symptoms', function (Blueprint $table) {
            $table->dropColumn('xray_result');
            $table->dropColumn('leukosit');
            $table->dropColumn('limfosit');
            $table->dropColumn('trombosit');
            $table->dropColumn('health_status');
        });
    }
}
