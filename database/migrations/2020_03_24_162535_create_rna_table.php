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
            // $table->string('nik_number')->nullable();
            $table->foreignId('registration_number_id')->nullable();
            $table->foreign('registration_number_id')->references('id')->on('registrations');
            $table->foreignId('sample_receive_taking_id')->nullable();
            $table->foreign('sample_receive_taking_id')->references('id')->on('sample_receive_takings');
            $table->dateTime('taken_date_time')->nullable();
            $table->string('receiver_officer')->nullable();
            $table->string('extraction_operator')->nullable();
            $table->dateTime('extraction_started_date_time')->nullable();
            $table->string('extraction_method')->nullable();
            $table->string('extraction_kit_name')->nullable();
            $table->dateTime('extraction_ended_date_time')->nullable();
            $table->string('sent_to')->nullable();
            $table->string('sender_name')->nullable();
            $table->dateTime('sent_date_time')->nullable();
            $table->text('notes')->nullable();
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
