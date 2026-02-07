<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // Allow these fields to be mass-assigned
    protected $fillable = ['user_id', 'title', 'city', 'price', 'image_url'];

    // Optional: Link to the User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
