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
        Schema::create('user_notification_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Channels
            $table->boolean('push_enabled')->default(false);
            $table->boolean('email_enabled')->default(false);
            
            // Categories
            $table->boolean('marketing_enabled')->default(false);
            $table->boolean('announcements_enabled')->default(false);
            $table->boolean('newsletter_enabled')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_notification_settings');
    }
};
