<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        if ($request->user()->hasVerifiedEmail()) {
            $user = $request->user();
            if ($user->isRenter()) {
                return redirect()->intended(route('renter.index'));
            } elseif ($user->isPropertyManager()) {
                return redirect()->intended(route('property_manager.index'));
            }
            return redirect()->intended(route('home'));
        }

        return view('auth.verify-email');
    }
}
