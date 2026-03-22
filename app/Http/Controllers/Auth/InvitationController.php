<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class InvitationController extends Controller
{
    /**
     * Display the invitation acceptance page (Step 1: Auth choice).
     */
    public function accept(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(403, 'The invitation link is invalid or has expired.');
        }

        $email = $request->get('email');
        $user = User::where('email', $email)
            ->where('status', 'invited')
            ->firstOrFail();

        return view('auth.accept-invitation', [
            'user' => $user,
        ]);
    }

    /**
     * Handle password-based invitation completion.
     */
    public function complete(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::where('email', $request->email)
            ->where('status', 'invited')
            ->firstOrFail();

        // Save password but stay in 'invited' status for final acceptance
        $user->update([
            'password' => Hash::make($request->password),
            'email_verified_at' => now(), // They verified by clicking the email link
        ]);

        Auth::login($user);

        return redirect()->route('invitation.summary');
    }

    /**
     * Display the final invitation summary (The Figma design).
     */
    public function summary()
    {
        $user = Auth::user();

        // Ensure only invited users can see this
        if ($user->status !== 'invited') {
            return redirect()->route('dashboard');
        }

        return view('auth.invitation-summary', compact('user'));
    }

    /**
     * Finalize the invitation (The "Accept invitation" button).
     */
    public function finalize()
    {
        $user = Auth::user();

        if ($user->status !== 'invited') {
            return redirect()->route('dashboard');
        }

        $user->update([
            'status' => 'active',
        ]);

        return redirect()->route('onboarding.index');
    }
}
