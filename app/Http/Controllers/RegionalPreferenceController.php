<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegionalPreferenceController extends Controller
{
    /**
     * Update the user's regional preferences.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'region' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'currency' => 'required|string|max:255',
            'measurement_unit' => 'required|string|in:m2,sqft',
        ]);

        $user = Auth::user();
        $user->update($validated);

        return response()->json([
            'message' => 'Regional preferences updated successfully.',
            'user' => $user
        ]);
    }
}
