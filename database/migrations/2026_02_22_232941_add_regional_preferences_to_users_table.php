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
            $table->string('region')->default('United Arab Emirates');
            $table->string('language')->default('English');
            $table->string('currency')->default('AED - United Arab Emirates Dirham');
            $table->string('measurement_unit')->default('m2'); // m2 or sqft
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['region', 'language', 'currency', 'measurement_unit']);
        });
    }
};
