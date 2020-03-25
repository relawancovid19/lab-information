<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('registrations')) {
            Schema::create('registrations', function (Blueprint $table) {
                $table->id();
                $table->string('registration_number');
                $table->string('sample_number');
                $table->string('dinkes_sender');
                $table->string('fasyankes_sender');
                $table->string('fasyankes_phone');
                $table->string('doctor');
                $table->date('registration_date');
                $table->string('reference_number');
                $table->bigInteger('patient_id')->unsigned();
                $table->foreign('patient_id')->references('id')->on('patients')
                    ->onDelete('cascade');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
