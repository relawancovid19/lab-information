<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class UpdateNullableFieldOnRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `registrations` 
        CHANGE COLUMN `dinkes_sender` `dinkes_sender` VARCHAR(191) CHARACTER SET "utf8" NULL,
        CHANGE COLUMN `fasyankes_sender` `fasyankes_sender` VARCHAR(191) CHARACTER SET "utf8" NULL,
        CHANGE COLUMN `fasyankes_phone` `fasyankes_phone` VARCHAR(191) CHARACTER SET "utf8" NULL,
        CHANGE COLUMN `doctor` `doctor` VARCHAR(191) CHARACTER SET "utf8" NULL,
        CHANGE COLUMN `registration_date` `registration_date` DATE NULL,
        CHANGE COLUMN `reference_number` `reference_number` VARCHAR(191) CHARACTER SET "utf8" NULL ;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `registrations` 
        CHANGE COLUMN `dinkes_sender` `dinkes_sender` VARCHAR(191) CHARACTER SET "utf8" NOT NULL,
        CHANGE COLUMN `fasyankes_sender` `fasyankes_sender` VARCHAR(191) CHARACTER SET "utf8" NOT NULL,
        CHANGE COLUMN `fasyankes_phone` `fasyankes_phone` VARCHAR(191) CHARACTER SET "utf8" NOT NULL,
        CHANGE COLUMN `doctor` `doctor` VARCHAR(191) CHARACTER SET "utf8" NOT NULL,
        CHANGE COLUMN `registration_date` `registration_date` DATE NOT NULL,
        CHANGE COLUMN `reference_number` `reference_number` VARCHAR(191) CHARACTER SET "utf8" NOT NULL ;');
    }
}
