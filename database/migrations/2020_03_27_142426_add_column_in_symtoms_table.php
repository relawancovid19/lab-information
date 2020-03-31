<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInSymtomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('symptoms', function (Blueprint $table) {
            $table->boolean('check_people_infected')->nullable();
            $table->boolean('check_family_members_infected')->nullable();
            $table->boolean('contact_with_suspect_covid19')->nullable();
        });

        Schema::table('contact_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('registration_id')->nullable();
            $table->foreign('registration_id')->references('id')->on('registrations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('symptoms', function (Blueprint $table) {

            if (Schema::hasColumn('check_people_infected', 'check_family_members_infected', 'contact_with_suspect_covid19')) {
                $table->dropColumn(['check_people_infected', 'check_family_members_infected', 'contact_with_suspect_covid19']);
            }

        });

        Schema::table('contact_histories', function (Blueprint $table) {
            $table->dropForeign('contact_histories_registration_id_foreign');
            $table->dropColumn(['registration_id']);
        });
    }
}
