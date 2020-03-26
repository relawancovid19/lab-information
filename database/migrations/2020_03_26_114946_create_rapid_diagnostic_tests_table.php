<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRapidDiagnosticTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapid_diagnostic_tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->timestamp('date_fever_first')->nullable();
            $table->timestamp('first_test_date')->nullable();
            $table->string('first_serum_sample_number')->nullable();
            $table->string('first_whole_blood_sample_number')->nullable();
            $table->enum('first_serum_result',['positive','negative','unknown'])->nullable();
            $table->enum('first_whole_blood_result',['positive','negative','unknown'])->nullable();
            $table->string('first_analyst')->nullable();
            $table->text('first_notes')->nullable();
            $table->timestamp('second_test_date')->nullable();
            $table->string('second_serum_sample_number')->nullable();
            $table->string('second_whole_blood_sample_number')->nullable();
            $table->enum('second_serum_result',['positive','negative','unknown'])->nullable();
            $table->enum('second_whole_blood_result',['positive','negative','unknown'])->nullable();
            $table->string('second_analyst')->nullable();
            $table->text('second_notes')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rapid_diagnostic_tests');
    }
}
