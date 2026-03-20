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

        // 4. Bathrooms (Query only)
        if ($request->filled('bathrooms')) {
            $bathValues = explode(',', $request->query('bathrooms'));
            $query->where(function($q) use ($bathValues) {
                foreach ($bathValues as $val) {
                    if ($val === '5+') {
                        $q->orWhere('bathrooms', '>=', 5);
                    } else {
                        $q->orWhere('bathrooms', $val);
                    }
                }
            });
        }

        // 5. Price (Query only)
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // 6. Area (Query only)
        if ($request->filled('min_area')) {
            $query->where('area', '>=', $request->min_area);
        }
        if ($request->filled('max_area')) {
            $query->where('area', '<=', $request->max_area);
        }

        // 7. Floor (Query only)
        if ($request->filled('min_floor')) {
            $query->where('floor_number', '>=', $request->min_floor);
        }
        if ($request->filled('max_floor')) {
            $query->where('floor_number', '<=', $request->max_floor);
        }

        // 8. Features (Query only)
        if ($request->filled('features')) {
            $featureSlugs = explode(',', $request->query('features'));
            foreach ($featureSlugs as $slug) {
                $query->whereHas('features', function($q) use ($slug) {
                    $q->whereRaw("LOWER(REPLACE(name, ' ', '-')) = ?", [$slug]);
                });
            }
        }

        // 9. Amenities (Query only)
        if ($request->filled('amenities')) {
            $amenitySlugs = explode(',', $request->query('amenities'));
            foreach ($amenitySlugs as $slug) {
                $query->whereHas('amenities', function($q) use ($slug) {
                    $q->whereRaw("LOWER(REPLACE(name, ' ', '-')) = ?", [$slug]);
                });
            }
        }

        // 10. Sorting
        $sort = $request->query('sort', 'popular');
        switch ($sort) {
            case 'low-to-high':
                $query->orderBy('price', 'asc');
                break;
            case 'high-to-low':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default: // popular
                $query->orderBy('views_count', 'desc');
                break;
        }

        $listings = $query->get();
        $maxListingPrice = Listing::where('status', 'Active')->max('price') ?: 1000000;
        $maxListingArea = Listing::where('status', 'Active')->max('area') ?: 10000;

        return view('listings.index', [
            'listings' => $listings,
            'maxListingPrice' => $maxListingPrice,
            'maxListingArea' => $maxListingArea,
            // Pass these back for the filters to stay in sync if needed, 
            // though they usually read from the request.
        ]);
    }
}
