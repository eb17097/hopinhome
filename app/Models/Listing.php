<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // This tells Laravel: "It's okay to save data into these columns"
    protected $fillable = ['title', 'city', 'price', 'image_url'];
}
