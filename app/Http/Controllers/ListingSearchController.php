<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ListingSearchController extends Controller
{
    public function index(Request $request, $location = null, $property_type = null, $bedrooms = null)
    {
        $query = Listing::query()->where('status', 'Active');

        // 1. Location (Path or Query)
        $loc = $location ?: $request->query('location');
        if ($loc && $loc !== 'all') {
            $formattedLoc = str_replace('-', ' ', $loc);
            $query->where(function($q) use ($formattedLoc) {
                $q->where('address', 'like', '%' . $formattedLoc . '%')
                  ->orWhere('name', 'like', '%' . $formattedLoc . '%');
            });
        }

        // 2. Property Type (Path or Query)
        $pType = $property_type ?: $request->query('property_type');
        if ($pType && $pType !== 'all') {
            $types = explode(',', $pType);
            $query->where(function($q) use ($types) {
                foreach ($types as $type) {
                    $formattedType = str_replace('-', ' ', $type);
                    $q->orWhere('property_type', 'like', $formattedType);
                }
            });
        }

        // 3. Bedrooms (Path or Query)
        $beds = $bedrooms ?: $request->query('bedrooms');
        if ($beds && $beds !== 'all') {
            $bedValues = explode(',', $beds);
            $query->whereIn('bedrooms', $bedValues);
        }

        // 4. Price (Query only)
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $listings = $query->latest()->get();

        return view('listings.index', [
            'listings' => $listings,
            // Pass these back for the filters to stay in sync if needed, 
            // though they usually read from the request.
        ]);
    }
}
