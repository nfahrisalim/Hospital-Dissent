<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFinishTimeToDoctorAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctor_availabilities', function (Blueprint $table) {
            $table->timestamp('finish_time')->nullable(); // Add finish_time column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_availabilities', function (Blueprint $table) {
            $table->dropColumn('finish_time'); // Remove finish_time column in case of rollback
        });
    }
}
