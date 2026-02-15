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
        Schema::table('listings', function (Blueprint $table) {
            // Rename 'title' to 'name' to better reflect its purpose
            $table->renameColumn('title', 'name');

            // Add new columns for the multi-step form, making them nullable for now
            $table->string('property_type')->nullable()->after('price');
            $table->text('address')->nullable()->after('property_type');
            $table->text('description')->nullable()->after('address');
            $table->integer('bedrooms')->nullable()->after('description');
            $table->integer('bathrooms')->nullable()->after('bedrooms');
            $table->integer('area')->nullable()->after('bathrooms');
            $table->integer('floor_number')->nullable()->after('area');
            $table->integer('total_floors')->nullable()->after('floor_number');
            $table->year('construction_year')->nullable()->after('total_floors');
            $table->string('video_url')->nullable()->after('construction_year');
            $table->string('payment_option')->nullable()->after('video_url');
            $table->string('utilities_option')->nullable()->after('payment_option');
            $table->integer('duration')->nullable()->after('utilities_option');
            $table->string('renewal_type')->nullable()->after('duration');
            
            // Make original price nullable and drop old columns
            $table->integer('price')->nullable()->change();
            $table->dropColumn(['city', 'image_url']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->renameColumn('name', 'title');

            $table->dropColumn([
                'property_type',
                'address',
                'description',
                'bedrooms',
                'bathrooms',
                'area',
                'floor_number',
                'total_floors',
                'construction_year',
                'video_url',
                'payment_option',
                'utilities_option',
                'duration',
                'renewal_type',
            ]);

            $table->integer('price')->nullable(false)->change();
            $table->string('city');
            $table->string('image_url');
        });
    }
};
