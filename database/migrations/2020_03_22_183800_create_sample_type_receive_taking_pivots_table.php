<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleTypeReceiveTakingPivotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_type_receive_taking_pivots', function (Blueprint $table) {
            $table->unsignedBigInteger('sample_receive_taking_id');
            $table->unsignedBigInteger('sample_type_id');
            $table->boolean('is_done');
            $table->string('sampling_officer')->nullable();
            $table->timestamp('sampling_date')->nullable();
            $table->string('sample_number')->nullable();

            $table->foreign('sample_receive_taking_id', 'foreign_sample_receive_taking')->references('id')->on('sample_receive_takings');
            $table->foreign('sample_type_id', 'foreign_sample_type')->references('id')->on('sample_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sample_type_receive_taking_pivots');
    }
}
