<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use FFMpeg;

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
        
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'property_type' => 'required|string',
                'address' => 'required|string',
                'description' => 'required|string',
                'bedrooms' => 'required|string',
                'bathrooms' => 'required|integer',
                'area' => 'required|integer',
                'floor_number' => 'nullable|integer',
                'total_floors' => 'nullable|integer',
                'construction_year' => 'required|integer',
                'payment_option' => 'required|string',
                'utilities_option' => 'required|string',
                'price' => 'required|numeric',
                'duration' => 'required|integer',
                'renewal_type' => 'required|string',
                'video_file' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:51200', // 50MB Max
                'photos' => 'nullable|array',
                'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'features' => 'nullable|array',
                'features.*' => 'exists:features,id',
                'amenities' => 'nullable|array',
                'amenities.*' => 'exists:amenities,id',
            ]);

            // Handle video upload and thumbnail generation
            if ($request->hasFile('video_file')) {
                $videoFile = $request->file('video_file');
                $videoOriginalName = pathinfo($videoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $videoExtension = $videoFile->getClientOriginalExtension();

                // Save video temporarily to local storage for FFmpeg processing
                $tempVideoPath = $videoFile->storeAs('temp_videos', $videoOriginalName . '-' . uniqid() . '.' . $videoExtension, 'local');
                $fullTempVideoPath = Storage::disk('local')->path($tempVideoPath);
                Log::info('Temp video saved locally:', ['path' => $fullTempVideoPath]);

                // Generate thumbnail
                $ffmpeg = FFMpeg::fromDisk('local')
                                ->open($tempVideoPath);
                
                $thumbnailFileName = 'thumbnails/' . $videoOriginalName . '-' . uniqid() . '.jpg';
                $tempThumbnailPath = Storage::disk('local')->path($thumbnailFileName);
                
                $ffmpeg->getFrameFromSeconds(1)
                       ->export()
                       ->toDisk('local')
                       ->save($thumbnailFileName);
                Log::info('Thumbnail generated locally:', ['path' => $tempThumbnailPath]);

                // Upload thumbnail to S3
                $thumbnailS3Path = 'apartments/' . $thumbnailFileName;
                Storage::disk('s3')->put($thumbnailS3Path, Storage::disk('local')->get($thumbnailFileName), 'public');
                $thumbnailUrl = Storage::disk('s3')->url($thumbnailS3Path);
                Log::info('Thumbnail uploaded to S3:', ['url' => $thumbnailUrl]);

                // Upload video to S3
                $videoS3Path = $videoFile->storePublicly('videos', 's3');
                $videoUrl = Storage::disk('s3')->url($videoS3Path);
                Log::info('Video uploaded to S3:', ['url' => $videoUrl]);

                $validatedData['video_url'] = $videoUrl;

                // Clean up temporary files
                Storage::disk('local')->delete([$tempVideoPath, $thumbnailFileName]);
                Log::info('Temporary video and thumbnail files deleted locally.');
            }

            DB::beginTransaction();

            $listing = auth()->user()->listings()->create($validatedData);

            // Attach generated thumbnail as the first image
            if (isset($thumbnailUrl)) {
                $listing->images()->create(['image_url' => $thumbnailUrl]);
                Log::info('Video thumbnail attached as first image.', ['url' => $thumbnailUrl]);
            }

            if ($request->hasFile('photos')) {
                Log::info('Processing photo uploads...');
                foreach ($request->file('photos') as $photo) {
                    Log::info('Uploading file:', ['original_name' => $photo->getClientOriginalName()]);
                    $path = $photo->storePublicly('apartments', 's3');
                    $url = Storage::disk('s3')->url($path);
                    Log::info('File stored on S3.', ['path' => $path, 'url' => $url]);
                    $listing->images()->create(['image_url' => $url]);
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
            return redirect()->route('manager.listings.index')->with('success', 'New listing created successfully!');

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

    // 3. Show a single listing
    public function show(Listing $listing)
    {
        $listing->load(['images', 'features', 'amenities', 'user']);
        return view('listings.show', ['listing' => $listing]);
    }

    // 4. Show all listings
    public function index()
    {
        $listings = Listing::latest()->get();
        return view('listings.index', ['listings' => $listings]);
    }

    // 5. Show user's listings
    public function myListings()
    {
        $listings = auth()->user()->listings()->latest()->get();
        return view('manager.listings.index', ['listings' => $listings]);
    }

    public function destroy(Listing $listing)
    {
        // Authorize that the user owns the listing
        if (auth()->user()->id !== $listing->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $listing->delete();

        return redirect()->route('manager.listings.index')->with('success', 'Listing deleted successfully.');
    }
}
