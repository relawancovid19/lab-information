<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSymptomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symptoms', function (Blueprint $table) {
            $table->id();
            $table->boolean('fever')->default(false);
            $table->boolean('cough')->default(false);
            $table->boolean('sore_throat')->default(false);
            $table->boolean('shortness_of_breath')->default(false);
            $table->boolean('flu')->default(false);
            $table->boolean('fatigue')->default(false);
            $table->boolean('headache')->default(false);
            $table->boolean('diarrhea')->default(false);
            $table->boolean('nausea_or_vomiting')->default(false);
            $table->boolean('comorbid')->default(false);
            $table->string('comorbid_description')->nullable();
            $table->string('other_symptoms')->nullable();
            $table->enum('pulmonary_xray', [0, 1, 2])->default(0)
                ->comment('0 = tidak dilakukan | 1 = gambaran pneumonia | 2 = tidak ada gambaran pneumonia');
            $table->boolean('using_ventilator')->default(false);
            $table->bigInteger('registration_id')->unsigned();
            $table->foreign('registration_id')->references('id')->on('registrations')
                ->onDelete('cascade');
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
        Schema::dropIfExists('symptoms');
    }
}
