<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class UpdateDefaultOptionOnSymptomps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `symptoms` 
        CHANGE COLUMN `fever` `fever` TINYINT(1) NULL DEFAULT NULL,
        CHANGE COLUMN `cough` `cough` TINYINT(1) NULL DEFAULT NULL,
        CHANGE COLUMN `sore_throat` `sore_throat` TINYINT(1) NULL DEFAULT NULL,
        CHANGE COLUMN `shortness_of_breath` `shortness_of_breath` TINYINT(1) NULL DEFAULT NULL,
        CHANGE COLUMN `flu` `flu` TINYINT(1) NULL DEFAULT NULL,
        CHANGE COLUMN `fatigue` `fatigue` TINYINT(1) NULL DEFAULT NULL,
        CHANGE COLUMN `headache` `headache` TINYINT(1) NULL DEFAULT NULL,
        CHANGE COLUMN `diarrhea` `diarrhea` TINYINT(1) NULL DEFAULT NULL,
        CHANGE COLUMN `nausea_or_vomiting` `nausea_or_vomiting` TINYINT(1) NULL DEFAULT NULL,
        CHANGE COLUMN `comorbid` `comorbid` TINYINT(1) NULL DEFAULT NULL,
        CHANGE COLUMN `using_ventilator` `using_ventilator` TINYINT(1) NULL DEFAULT NULL;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `symptoms`
        CHANGE COLUMN `fever` `fever` TINYINT(1) NULL DEFAULT "0",
        CHANGE COLUMN `cough` `cough` TINYINT(1) NULL DEFAULT "0",
        CHANGE COLUMN `sore_throat` `sore_throat` TINYINT(1) NULL DEFAULT "0",
        CHANGE COLUMN `shortness_of_breath` `shortness_of_breath` TINYINT(1) NULL DEFAULT "0",
        CHANGE COLUMN `flu` `flu` TINYINT(1) NULL DEFAULT "0",
        CHANGE COLUMN `fatigue` `fatigue` TINYINT(1) NULL DEFAULT "0",
        CHANGE COLUMN `headache` `headache` TINYINT(1) NULL DEFAULT "0",
        CHANGE COLUMN `diarrhea` `diarrhea` TINYINT(1) NULL DEFAULT "0",
        CHANGE COLUMN `nausea_or_vomiting` `nausea_or_vomiting` TINYINT(1) NULL DEFAULT "0",
        CHANGE COLUMN `comorbid` `comorbid` TINYINT(1) NULL DEFAULT "0",
        CHANGE COLUMN `using_ventilator` `using_ventilator` TINYINT(1) NULL DEFAULT "0" ;');
    }
}
