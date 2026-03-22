<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle(Request $request)
    {
        // Store invitation context if present
        if ($request->has('invitation_email')) {
            session([
                'invitation_email' => $request->get('invitation_email'),
                'invitation_token' => $request->get('invitation_token'),
            ]);
        }

        // Force the account selection screen
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if we are in an invitation flow
            $invitationEmail = session('invitation_email');
            
            if ($invitationEmail) {
                // Security: Ensure the Google email matches the invited email
                if (strtolower($googleUser->email) !== strtolower($invitationEmail)) {
                    $token = session('invitation_token');
                    session()->forget(['invitation_email', 'invitation_token']);
                    
                    return redirect()->route('invitation.accept', [
                        'email' => $invitationEmail,
                        'signature' => $token
                    ])->withErrors(['email' => 'Please use the Google account associated with ' . $invitationEmail]);
                }

                // Find the invited record
                $user = User::where('email', $invitationEmail)
                    ->where('status', 'invited')
                    ->first();

                if ($user) {
                    // "Claim" the record
                    $user->update([
                        'google_id' => $googleUser->id,
                        'email_verified_at' => now(),
                    ]);

                    Auth::login($user);
                    session()->forget(['invitation_email', 'invitation_token']);
                    
                    return redirect()->route('invitation.summary');
                }
            }

            // Standard Login/Registration Flow
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                Auth::login($user);
            } else {
                $existingUser = User::where('email', $googleUser->email)->first();

                if ($existingUser) {
                    // Link to existing user if they have the same email
                    $existingUser->update(['google_id' => $googleUser->id]);
                    Auth::login($existingUser);
                } else {
                    // Create new user (default to Renter)
                    $user = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'role' => 'renter',
                        'password' => bcrypt(Str::random(16)),
                        'email_verified_at' => now(),
                    ]);
                    Auth::login($user);
                }
            }

            return redirect()->intended(route('dashboard'));

        } catch (\Exception $e) {
            return redirect()->route('home')->withErrors(['email' => 'Unable to login with Google. Please try again.']);
        }
    }
}
