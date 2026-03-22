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
     * Display the invitation acceptance page.
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
     * Complete the invitation by setting a password.
     */
    public function complete(Request $request)
    {
        // Re-verify the signature for the POST request
        if (!$request->hasValidSignature()) {
            return back()->withErrors(['email' => 'The session has expired. Please click the link in your email again.']);
        }

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::where('email', $request->email)
            ->where('status', 'invited')
            ->firstOrFail();

        // Update and activate the user
        $user->update([
            'password' => Hash::make($request->password),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
