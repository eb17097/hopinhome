<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OnboardingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->onboarding_completed) {
            return redirect()->route('dashboard');
        }

        return view('onboarding.step' . $user->onboarding_step);
    }

    public function step1(Request $request)
    {
        $request->validate([
            'role_intent' => 'required|string|in:renter,agent,brokerage,owner',
        ]);

        $user = Auth::user();
        
        // Map intents to actual roles
        $roleMap = [
            'renter' => 'renter',
            'agent' => 'property_manager',
            'brokerage' => 'property_manager',
            'owner' => 'property_manager',
        ];

        $user->update([
            'role' => $roleMap[$request->role_intent],
            'onboarding_step' => 2, // Move to next step
        ]);

        return response()->json([
            'status' => 'success',
            'redirect' => route('onboarding.index'),
        ]);
    }

    public function step2(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();

        $user->update([
            'bio' => $request->bio,
            'onboarding_step' => 3,
        ]);

        return response()->json([
            'status' => 'success',
            'redirect' => route('onboarding.index'),
        ]);
    }

    public function step3(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('Onboarding step3 hit', ['has_file' => $request->hasFile('photo')]);

        $request->validate([
            'photo' => 'nullable|image|max:5120',
        ]);

        $user = Auth::user();

        if ($request->hasFile('photo')) {
            // Delete old photo if exists and is local
            if ($user->profile_photo_url && !filter_var($user->profile_photo_url, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($user->profile_photo_url);
            }

            $path = $request->file('photo')->store('profile-photos', 'public');
            \Illuminate\Support\Facades\Log::info('New photo stored', ['path' => $path]);
            $user->profile_photo_url = $path;
            $user->save();
        }

        $user->onboarding_step = 4;
        $user->save();

        \Illuminate\Support\Facades\Log::info('User onboarding step updated', ['step' => $user->onboarding_step, 'photo_url' => $user->profile_photo_url]);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'redirect' => route('onboarding.index'),
            ]);
        }

        return redirect()->route('onboarding.index');
    }

    public function complete()
    {
        $user = Auth::user();

        $user->update([
            'onboarding_completed' => true,
        ]);

        return response()->json([
            'status' => 'success',
            'redirect' => route('dashboard'),
        ]);
    }
}
