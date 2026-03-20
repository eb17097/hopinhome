<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * The listings that belong to the feature.
     */
    public function listings()
    {
        return $this->belongsToMany(Listing::class, 'feature_listing');
    }
}
