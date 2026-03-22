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
            $invitationEmail = session('invitation_email');
            
            // 1. Handle Explicit Invitation Flow (via invite link)
            if ($invitationEmail) {
                // Security check: Match Google email with invited email
                if (strtolower($googleUser->email) !== strtolower($invitationEmail)) {
                    $token = session('invitation_token');
                    session()->forget(['invitation_email', 'invitation_token']);
                    
                    return redirect()->route('invitation.accept', [
                        'email' => $invitationEmail,
                        'signature' => $token
                    ])->withErrors(['email' => 'Please use the Google account associated with ' . $invitationEmail]);
                }

                $invitedUser = User::where('email', $invitationEmail)->where('status', 'invited')->first();
                if ($invitedUser) {
                    $invitedUser->update([
                        'google_id' => $googleUser->id,
                        'email_verified_at' => now()
                    ]);
                    
                    Auth::login($invitedUser);
                    session()->forget(['invitation_email', 'invitation_token']);
                    return redirect()->route('invitation.summary');
                }
            }

            // 2. Standard Login/Registration Flow
            // Find user by Google ID first
            $user = User::where('google_id', $googleUser->id)->first();
            
            if (!$user) {
                // Fallback to searching by email if Google ID not linked yet
                $user = User::where('email', $googleUser->email)->first();
                
                if ($user) {
                    // Link existing account to this Google ID
                    $user->update(['google_id' => $googleUser->id]);
                } else {
                    // Create a completely new Renter account
                    $user = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'role' => 'renter',
                        'password' => bcrypt(Str::random(16)),
                        'email_verified_at' => now(),
                    ]);
                }
            }

            Auth::login($user);

            // 3. Final Security/Handshake Check
            // If they are an invited agent who hasn't accepted yet, show summary
            if ($user->status === 'invited') {
                return redirect()->route('invitation.summary');
            }

            return redirect()->intended(route('dashboard'));

        } catch (\Exception $e) {
            return redirect()->route('home')->withErrors(['email' => 'Unable to login with Google. Please try again.']);
        }
    }
}
