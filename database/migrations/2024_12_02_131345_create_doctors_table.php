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
    Schema::create('doctors', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('photo')->nullable();  // Foto profil dokter
        $table->string('specialization');
        $table->string('gender');
        $table->date('birthdate');
        $table->integer('years_of_experience');
        $table->text('education')->nullable();
        $table->text('achievements')->nullable();
        $table->text('medical_experience')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
