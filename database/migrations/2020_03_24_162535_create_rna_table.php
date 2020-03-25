<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRnaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rna', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
            $table->string('registration_number');
            // $table->foreign('registration_number_id', 'foreign_registrations')->references('id')->on('registrations');
            $table->foreign('sample_receive_taking_id', 'foreign_sample_receive_taking')->references('id')->on('sample_receive_takings');
            $table->date('taken_date');
            $table->time('taken_time');
            $table->string('receiver_officer')->nullable();
            $table->string('operator_extraction')->nullable();
            $table->date('extraction_started_date');
            $table->time('extraction_started_time');
            $table->string('extraction_method')->nullable();
            $table->string('extraction_kit_name')->nullable();
            $table->date('extraction_ended_date');
            $table->time('extraction_ended_time');
            $table->string('sent_to')->nullable();
            $table->string('sender_name')->nullable();
            $table->date('sent_date');
            $table->time('sent_time');
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
        Schema::dropIfExists('rna');
    }
}
