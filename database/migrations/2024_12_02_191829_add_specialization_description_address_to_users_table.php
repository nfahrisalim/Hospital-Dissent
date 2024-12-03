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
    Schema::table('users', function (Blueprint $table) {
        $table->string('specialization')->nullable();  // Specialization column
        $table->text('description')->nullable();  // Description column
        $table->string('address')->nullable();  // Address column
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('specialization');
        $table->dropColumn('description');
        $table->dropColumn('address');
    });
}
};
