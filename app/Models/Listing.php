<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'price', 'property_type', 'address', 'description',
        'bedrooms', 'bathrooms', 'area', 'floor_number', 'total_floors',
        'construction_year', 'video_url', 'payment_option', 'utilities_option',
        'duration', 'renewal_type',
        'latitude',
        'longitude'
    ];

    /**
     * Get the user that owns the listing.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the images for the listing.
     */
    public function images()
    {
        return $this->hasMany(ListingImage::class);
    }

    /**
     * The features that belong to the listing.
     */
    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_listing');
    }

    /**
     * The amenities that belong to the listing.
     */
    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'amenity_listing');
    }
}
