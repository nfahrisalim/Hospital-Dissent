<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {   
    Schema::create('doctor_availabilities', function (Blueprint $table) {
        $table->id();
        $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
        $table->dateTime('availability_date');
        $table->string('status'); // Tersedia, Cuti, Istirahat, dll.
        $table->timestamps();
    });
}

    public function down()
    {
    Schema::dropIfExists('doctor_availabilities');
    }

};
