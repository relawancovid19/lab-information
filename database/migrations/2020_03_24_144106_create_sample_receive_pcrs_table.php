<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleReceivePcrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_receive_pcrs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registration_id');
            $table->string('sample_number');

            $table->datetime('rna_datetime');
            $table->string('from_lab');
            $table->string('sampling_officer');
            $table->string('pcr_operator');
            $table->datetime('check_start_datetime');
            $table->string('check_type');
            $table->string('check_kit');
            $table->string('gen_target');
            $table->datetime('check_finish_datetime');
            $table->string('result');
            $table->enum('conclusion', [0, 1, 2])->default(0)
                ->comment('0 = negatif | 1 = positif | 2 = tidak dapat ditentukan');
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->foreign('registration_id', 'foreign_registration')->references('id')->on('registrations');
            $table->index('sample_number', 'sample_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sample_receive_pcrs');
    }
}
