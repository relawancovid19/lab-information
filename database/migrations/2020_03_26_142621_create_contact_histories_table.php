<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_histories', function (Blueprint $table) {
            $table->id();
            $table->boolean('check_patient_journey')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->date('date_of_visit')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->boolean('check_contact_sick_people')->nullable();
            $table->string('name_people_sick')->nullable();
            $table->string('address')->nullable();
            $table->string('relation')->nullable();
            $table->date('contact_date')->nullable();
            $table->boolean('check_people_infected')->nullable();
            $table->boolean('check_family_members_infected')->nullable();
            $table->text('other')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('symptoms', function (Blueprint $table) {
            $table->boolean('hipertensi')->nullable();
            $table->boolean('diabetes_mellitus')->nullable();
            $table->boolean('liver')->nullable();
            $table->boolean('neurologi')->nullable();
            $table->boolean('hiv')->nullable();
            $table->boolean('kidney')->nullable();
            $table->boolean('chronic_lung')->nullable();
        });

        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn('sample_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_histories');

        Schema::table('symptoms', function (Blueprint $table) {
            $table->dropColumn('hipertensi');
            $table->dropColumn('diabetes_mellitus');
            $table->dropColumn('liver');
            $table->dropColumn('neurologi');
            $table->dropColumn('hiv');
            $table->dropColumn('kidney');
            $table->dropColumn('chronic_lung');
        });

        Schema::table('registrations', function (Blueprint $table) {
            $table->string('sample_number')->nullable();
        });
    }
}
