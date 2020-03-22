<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleReceiveTakingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_receive_takings', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number');
            $table->boolean('sample_taken');
            $table->boolean('sample_taken_from_fasyankes');
            $table->string('sample_receiver_officer');
            $table->text('notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sample_receive_takings');
    }
}
