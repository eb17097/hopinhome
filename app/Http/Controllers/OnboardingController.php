<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
