<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if a user with this google_id already exists
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                // If the user exists, log them in
                Auth::login($user);
                
                return redirect()->intended(route('dashboard', absolute: false));
            } else {
                // Check if a user with this email exists but no google_id
                $existingUser = User::where('email', $googleUser->email)->first();

                if ($existingUser) {
                    // Link the google_id to the existing user
                    $existingUser->update([
                        'google_id' => $googleUser->id,
                    ]);
                    Auth::login($existingUser);
                } else {
                    // Create a new user
                    $newUser = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'role' => 'renter', // Default role
                        // Generate a random password since they are using Google auth
                        'password' => bcrypt(Str::random(16)), 
                    ]);
                    Auth::login($newUser);
                }

                $user = Auth::user();
                return redirect()->intended(route('dashboard', absolute: false));
            }

        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return redirect()->route('home')->withErrors(['email' => 'Unable to login with Google. Please try again.']);
        }
    }
}
