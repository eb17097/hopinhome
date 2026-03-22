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
            $table->foreignId('business_owner_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('status')->default('active'); // active, invited, inactive
            $table->integer('listing_limit')->nullable();
            $table->integer('boost_limit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['business_owner_id']);
            $table->dropColumn(['business_owner_id', 'status', 'listing_limit', 'boost_limit']);
        });
    }
};
