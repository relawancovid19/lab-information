<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentHistoryPdpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_history_pdps', function (Blueprint $table) {
            $table->id();
            $table->string('explanation')->nullable();
            $table->date('date_treated')->nullable();
            $table->string('fasyankes_name')->nullable();
            $table->unsignedInteger('patient_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatment_history_pdps');
    }
}
