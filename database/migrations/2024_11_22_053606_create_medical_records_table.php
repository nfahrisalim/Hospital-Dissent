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
    Schema::create('medical_records', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pasien_id')->constrained('users')->onDelete('cascade'); // Mengacu pada tabel users
        $table->foreignId('dokter_id')->constrained('users')->onDelete('cascade'); // Mengacu pada tabel users
        $table->date('tanggal_berobat');
        $table->text('tindakan_medis');
        $table->timestamps();
    });

    Schema::create('medical_record_medicine', function (Blueprint $table) {
        $table->id();
        $table->foreignId('medical_record_id')->constrained('medical_records')->onDelete('cascade');
        $table->foreignId('medicine_id')->constrained('medicines')->onDelete('cascade');
        $table->timestamps();
    });
}

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
