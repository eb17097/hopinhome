<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    // 1. Show the form
    public function create()
    {
        $propertyTypes = ['Apartment', 'Villa', 'House', 'Townhouse', 'Hotel apartment', 'Penthouse'];
        $features = \App\Models\Feature::all();
        $amenities = \App\Models\Amenity::all();
        return view('listings.create', compact('propertyTypes', 'features', 'amenities'));
    }

    public function edit(Listing $listing)
    {
        if (auth()->id() !== $listing->user_id) {
            abort(403);
        }

        $propertyTypes = ['Apartment', 'Villa', 'House', 'Townhouse', 'Hotel apartment', 'Penthouse'];
        $features = \App\Models\Feature::all();
        $amenities = \App\Models\Amenity::all();
        $listing->load(['features', 'amenities', 'images']);

        return view('listings.create', compact('listing', 'propertyTypes', 'features', 'amenities'));
    }

    public function store(Request $request)
    {
        Log::info('--- Starting Listing Creation Process ---');
        Log::info('Incoming Request Data:', $request->except('photos')); // Don't log file content

        // Decode JSON strings for features and amenities if they are present
        $features = json_decode($request->input('features'), true) ?? [];
        $amenities = json_decode($request->input('amenities'), true) ?? [];

        $request->merge([
            'features' => $features,
            'amenities' => $amenities,
        ]);

        $isDraft = $request->input('status') === 'Draft';
        
        try {
            $rules = [
                'name' => $isDraft ? 'nullable|string|max:255' : 'required|string|max:255',
                'property_type' => $isDraft ? 'nullable|string' : 'required|string',
                'address' => $isDraft ? 'nullable|string' : 'required|string',
                'description' => $isDraft ? 'nullable|string' : 'required|string',
                'bedrooms' => $isDraft ? 'nullable|string' : 'required|string',
                'bathrooms' => $isDraft ? 'nullable|integer|min:0' : 'required|integer|min:0',
                'area' => $isDraft ? 'nullable|integer|min:0' : 'required|integer|min:0',
                'floor_number' => 'nullable|integer|min:0',
                'total_floors' => 'nullable|integer|min:0',
                'construction_year' => $isDraft ? 'nullable|integer|min:0' : 'required|integer|min:0',
                'payment_option' => $isDraft ? 'nullable|string' : 'required|string',
                'utilities_option' => $isDraft ? 'nullable|string' : 'required|string',
                'price' => $isDraft ? 'nullable|numeric|min:0' : 'required|numeric|min:0',
                'duration' => $isDraft ? 'nullable|integer|min:0' : 'required|integer|min:0',
                'renewal_type' => $isDraft ? 'nullable|string' : 'required|string',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'status' => 'nullable|string',
                'current_step' => 'nullable|integer|min:1|max:10',
                'video_file' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:51200', // 50MB Max
                'photos' => 'nullable|array',
                'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'features' => 'nullable|array',
                'features.*' => 'exists:features,id',
                'amenities' => 'nullable|array',
                'amenities.*' => 'exists:amenities,id',
            ];

            $validatedData = $request->validate($rules);

            // Ensure status is set correctly
            if ($isDraft) {
                $validatedData['status'] = 'Draft';
            } else {
                // We keep it as draft until they actually publish from the preview page
                $validatedData['status'] = 'Draft';
            }

            // Handle video upload
            if ($request->hasFile('video_file')) {
                $videoFile = $request->file('video_file');

                // Upload video to S3
                $videoS3Path = $videoFile->storePublicly('videos', 's3');
                $videoUrl = Storage::disk('s3')->url($videoS3Path);
                Log::info('Video uploaded to S3:', ['url' => $videoUrl]);

                $validatedData['video_url'] = $videoUrl;
            }

            DB::beginTransaction();

            $listing = auth()->user()->listings()->create($validatedData);

            if ($request->hasFile('photos')) {
                Log::info('Processing photo uploads...');
                foreach ($request->file('photos') as $index => $photo) {
                    Log::info('Uploading file:', ['original_name' => $photo->getClientOriginalName()]);
                    $path = $photo->storePublicly('apartments', 's3');
                    $url = Storage::disk('s3')->url($path);
                    Log::info('File stored on S3.', ['path' => $path, 'url' => $url]);
                    $listing->images()->create(['image_url' => $url, 'sequence' => $index]);
                }
            }

            if (!empty($validatedData['features'])) {
                $listing->features()->sync($validatedData['features']);
            }
            if (!empty($validatedData['amenities'])) {
                $listing->amenities()->sync($validatedData['amenities']);
            }

            DB::commit();

            Log::info('--- Listing Creation SUCCESS ---', ['listing_id' => $listing->id]);
            
            if ($request->filled('redirect_to')) {
                return redirect($request->input('redirect_to'))->with('success', 'Listing saved as draft!');
            }
            
            if ($isDraft) {
                return redirect()->route('property_manager.listings.index')->with('success', 'Listing saved as draft!');
            }

            return redirect()->route('property_manager.listings.preview', $listing);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Laravel's validator handles the redirect. We just log the failure.
            Log::warning('--- Listing Creation FAILED: Validation Error ---', ['errors' => $e->errors()]);
            throw $e; // Re-throw to let Laravel handle the redirect
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('--- Listing Creation FAILED: An unexpected error occurred ---', [
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'There was a critical error creating your listing. Please try again.')->withInput();
        }
    }
    
    // ... (other methods)
    // ... (other methods remain unchanged)

    public function update(Request $request, Listing $listing)
    {
        if (auth()->id() !== $listing->user_id) {
            abort(403);
        }

        Log::info('--- Starting Listing Update Process ---', ['listing_id' => $listing->id]);
        
        // Decode JSON strings for features and amenities
        $features = json_decode($request->input('features'), true) ?? [];
        $amenities = json_decode($request->input('amenities'), true) ?? [];

        $request->merge([
            'features' => $features,
            'amenities' => $amenities,
        ]);

        $isDraft = $request->input('status') === 'Draft' || ($listing->status === 'Draft' && !$request->has('status'));

        try {
            $rules = [
                'name' => $isDraft ? 'nullable|string|max:255' : 'required|string|max:255',
                'property_type' => $isDraft ? 'nullable|string' : 'required|string',
                'address' => $isDraft ? 'nullable|string' : 'required|string',
                'description' => $isDraft ? 'nullable|string' : 'required|string',
                'bedrooms' => $isDraft ? 'nullable|string' : 'required|string',
                'bathrooms' => $isDraft ? 'nullable|integer|min:0' : 'required|integer|min:0',
                'area' => $isDraft ? 'nullable|integer|min:0' : 'required|integer|min:0',
                'floor_number' => 'nullable|integer|min:0',
                'total_floors' => 'nullable|integer|min:0',
                'construction_year' => $isDraft ? 'nullable|integer|min:0' : 'required|integer|min:0',
                'payment_option' => $isDraft ? 'nullable|string' : 'required|string',
                'utilities_option' => $isDraft ? 'nullable|string' : 'required|string',
                'price' => $isDraft ? 'nullable|numeric|min:0' : 'required|numeric|min:0',
                'duration' => $isDraft ? 'nullable|integer|min:0' : 'required|integer|min:0',
                'renewal_type' => $isDraft ? 'nullable|string' : 'required|string',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'status' => 'nullable|string',
                'current_step' => 'nullable|integer|min:1|max:10',
                'video_file' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:51200',
                'photos' => 'nullable|array',
                'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'features' => 'nullable|array',
                'features.*' => 'exists:features,id',
                'amenities' => 'nullable|array',
                'amenities.*' => 'exists:amenities,id',
            ];

            $validatedData = $request->validate($rules);

            if ($request->has('status')) {
                $validatedData['status'] = $request->input('status');
            } else {
                // We keep it as draft until they actually publish from the preview page
                $validatedData['status'] = 'Draft';
            }

            // Handle video upload
            if ($request->hasFile('video_file')) {
                $videoFile = $request->file('video_file');
                $videoS3Path = $videoFile->storePublicly('videos', 's3');
                $videoUrl = Storage::disk('s3')->url($videoS3Path);
                $validatedData['video_url'] = $videoUrl;
            }

            DB::beginTransaction();

            $listing->update($validatedData);

            if ($request->hasFile('photos')) {
                // For simplicity, we just add new photos. 
                // A better implementation would handle deletions/reordering.
                $lastSequence = $listing->images()->max('sequence') ?? -1;
                foreach ($request->file('photos') as $index => $photo) {
                    $path = $photo->storePublicly('apartments', 's3');
                    $url = Storage::disk('s3')->url($path);
                    $listing->images()->create(['image_url' => $url, 'sequence' => $lastSequence + $index + 1]);
                }
            }

            if (isset($validatedData['features'])) {
                $listing->features()->sync($validatedData['features']);
            }
            if (isset($validatedData['amenities'])) {
                $listing->amenities()->sync($validatedData['amenities']);
            }

            DB::commit();

            Log::info('--- Listing Update SUCCESS ---', ['listing_id' => $listing->id]);

            if ($request->filled('redirect_to')) {
                return redirect($request->input('redirect_to'))->with('success', 'Listing updated!');
            }

            if ($isDraft) {
                return redirect()->route('property_manager.listings.index')->with('success', 'Listing updated successfully!');
            }

            return redirect()->route('property_manager.listings.preview', $listing);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('--- Listing Update FAILED ---', [
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'There was an error updating your listing.')->withInput();
        }
    }

    // 3. Show a single listing
    public function show(Listing $listing)
    {
        if ($listing->status !== 'Active' && (!auth()->check() || auth()->id() !== $listing->user_id)) {
            abort(404);
        }

        $listing->load(['images', 'features', 'amenities', 'user']);
        return view('listings.show', ['listing' => $listing]);
    }

    // 4. Show all listings
    public function index(Request $request)
    {
        $query = Listing::query()->where('status', 'Active');

        if ($request->filled('location')) {
            $query->where(function($q) use ($request) {
                $q->where('address', 'like', '%' . $request->location . '%')
                  ->orWhere('name', 'like', '%' . $request->location . '%');
            });
        }

        if ($request->filled('property_types')) {
            $query->whereIn('property_type', $request->property_types);
        }

        if ($request->filled('bedrooms')) {
            $query->whereIn('bedrooms', $request->bedrooms);
        }

        if ($request->filled('bathrooms')) {
            $bathValues = is_array($request->bathrooms) ? $request->bathrooms : explode(',', $request->bathrooms);
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

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('min_area')) {
            $query->where('area', '>=', $request->min_area);
        }

        if ($request->filled('max_area')) {
            $query->where('area', '<=', $request->max_area);
        }

        if ($request->filled('min_floor')) {
            $query->where('floor_number', '>=', $request->min_floor);
        }

        if ($request->filled('max_floor')) {
            $query->where('floor_number', '<=', $request->max_floor);
        }

        if ($request->filled('features')) {
            $featureSlugs = is_array($request->features) ? $request->features : explode(',', $request->features);
            foreach ($featureSlugs as $slug) {
                $query->whereHas('features', function($q) use ($slug) {
                    $q->whereRaw("LOWER(REPLACE(name, ' ', '-')) = ?", [$slug]);
                });
            }
        }

        if ($request->filled('amenities')) {
            $amenitySlugs = is_array($request->amenities) ? $request->amenities : explode(',', $request->amenities);
            foreach ($amenitySlugs as $slug) {
                $query->whereHas('amenities', function($q) use ($slug) {
                    $q->whereRaw("LOWER(REPLACE(name, ' ', '-')) = ?", [$slug]);
                });
            }
        }

        // Sorting
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

        $allFeatures = \App\Models\Feature::whereHas('listings', function($q) {
            $q->where('status', 'Active');
        })->orderBy('name')->get();

        $allAmenities = \App\Models\Amenity::whereHas('listings', function($q) {
            $q->where('status', 'Active');
        })->orderBy('name')->get();

        return view('listings.index', [
            'listings' => $listings, 
            'maxListingPrice' => $maxListingPrice,
            'maxListingArea' => $maxListingArea,
            'allFeatures' => $allFeatures,
            'allAmenities' => $allAmenities
        ]);
    }

    // 5. Show user's listings
    public function myListings(Request $request)
    {
        $query = auth()->user()->listings();

        // Search filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Status filter
        if ($request->filled('status') && $request->status !== 'All status') {
            $query->where('status', $request->status);
        }

        // Property type filter
        if ($request->filled('property_type') && $request->property_type !== 'All types') {
            $query->where('property_type', $request->property_type);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        if ($sort === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $perPage = $request->get('per_page', 10);
        $listings = $query->paginate($perPage)->withQueryString();

        $statuses = ['Active', 'In review', 'Declined', 'Expired', 'Draft'];
        $propertyTypes = ['Apartment', 'Villa', 'House', 'Townhouse', 'Hotel apartment', 'Penthouse'];

        return view('property_manager.listings', compact('listings', 'statuses', 'propertyTypes'));
    }

    public function preview(Listing $listing)
    {
        if (auth()->id() !== $listing->user_id) {
            abort(403);
        }

        $listing->load(['images', 'features', 'amenities', 'user']);
        return view('listings.preview', ['listing' => $listing]);
    }

    public function publish(Listing $listing)
    {
        if (auth()->id() !== $listing->user_id) {
            abort(403);
        }

        $listing->update(['status' => 'Active']);

        return redirect()->route('property_manager.index')->with('success', 'Listing published successfully!');
    }

    public function destroy(Listing $listing)
    {
        // Authorize that the user owns the listing
        if (auth()->user()->id !== $listing->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $listing->delete();

        return redirect()->route('property_manager.listings.index')->with('success', 'Listing deleted successfully.');
    }
}
