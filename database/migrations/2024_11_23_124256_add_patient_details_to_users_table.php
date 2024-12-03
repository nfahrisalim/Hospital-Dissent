<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->float('height')->nullable()->after('role');
            $table->float('weight')->nullable()->after('height');
            $table->string('blood_type', 3)->nullable()->after('weight');
            $table->string('family_contact_name')->nullable()->after('blood_type');
            $table->string('family_contact_phone')->nullable()->after('family_contact_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('height');
            $table->dropColumn('weight');
            $table->dropColumn('blood_type');
            $table->dropColumn('family_contact_name');
            $table->dropColumn('family_contact_phone');
        });
    }
};
