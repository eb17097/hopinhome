<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    /**
     * Display the invitation acceptance page.
     */
    public function accept(Request $request)
    {
        // Ensure the URL is valid and hasn't been tampered with
        if (!$request->hasValidSignature()) {
            abort(403, 'The invitation link is invalid or has expired.');
        }

        $email = $request->get('email');
        
        // Find the "invited" user
        $user = User::where('email', $email)
            ->where('status', 'invited')
            ->firstOrFail();

        return view('auth.accept-invitation', [
            'user' => $user,
        ]);
    }
}
