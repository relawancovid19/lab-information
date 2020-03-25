<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class UpdateNullableFieldOnPatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `patients` 
        CHANGE COLUMN `date_of_birth` `date_of_birth` DATE NULL,
        CHANGE COLUMN `age_year` `age_year` INT(11) NULL,
        CHANGE COLUMN `gender` `gender` ENUM("Laki-laki", "Perempuan") CHARACTER SET "utf8" NULL,
        CHANGE COLUMN `address_1` `address_1` VARCHAR(191) CHARACTER SET "utf8" NULL,
        CHANGE COLUMN `address_2` `address_2` VARCHAR(191) CHARACTER SET "utf8" NULL,
        CHANGE COLUMN `phone_number` `phone_number` VARCHAR(191) CHARACTER SET "utf8" NULL ;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `patients` 
        CHANGE COLUMN `date_of_birth` `date_of_birth` DATE NOT NULL,
        CHANGE COLUMN `age_year` `age_year` INT(11) NOT NULL DEFAULT "0",
        CHANGE COLUMN `gender` `gender` ENUM("Laki-laki", "Perempuan") CHARACTER SET "utf8" NOT NULL,
        CHANGE COLUMN `address_1` `address_1` VARCHAR(191) CHARACTER SET "utf8" NOT NULL,
        CHANGE COLUMN `address_2` `address_2` VARCHAR(191) CHARACTER SET "utf8" NOT NULL,
        CHANGE COLUMN `phone_number` `phone_number` VARCHAR(191) CHARACTER SET "utf8" NOT NULL ;');
    }
}
