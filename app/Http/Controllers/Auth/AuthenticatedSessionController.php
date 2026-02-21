<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use Illuminate\Http\JsonResponse;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->isRenter()) {
            return redirect()->route('renter.index');
        } elseif ($user->isPropertyManager()) {
            return redirect()->route('property_manager.index');
        }

        return redirect()->route('home');
    }

    /**
     * Handle an incoming API authentication request.
     */
    public function apiStore(LoginRequest $request): JsonResponse
    {
        $request->ensureIsNotRateLimited();

        $user = \App\Models\User::where('email', $request->email)->first();

        if (! $user || ! \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            \Illuminate\Support\Facades\RateLimiter::hit($request->throttleKey());
            return response()->json([
                'errors' => ['email' => [trans('auth.failed')]],
            ], 422);
        }

        \Illuminate\Support\Facades\RateLimiter::clear($request->throttleKey());

        if ($user->two_factor_auth) {
            $request->session()->put('2fa_user_id', $user->id);

            $code = random_int(100000, 999999);
            \Illuminate\Support\Facades\Cache::put('otp_' . $user->email, $code, 600);
            \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\OTPCode($code));

            return response()->json([
                'status' => '2fa_required', 
                'message' => 'A verification code has been sent to your email.'
            ]);
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        $redirectUrl = route('home');

        if ($user->isRenter()) {
            $redirectUrl = route('renter.index');
        } elseif ($user->isPropertyManager()) {
            $redirectUrl = route('property_manager.index');
        }

        return response()->json([
            'status' => 'success', 
            'message' => 'Login successful',
            'redirect' => $redirectUrl
        ]);
    }

    /**
     * Verify the 2FA code and log the user in.
     */
    public function verifyLogin2fa(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6',
        ]);

        $userId = $request->session()->get('2fa_user_id');
        
        if (!$userId) {
            return response()->json(['status' => 'error', 'message' => 'Session expired. Please log in again.'], 400);
        }

        $user = \App\Models\User::find($userId);

        if (!$user || $user->email !== $request->email) {
            return response()->json(['status' => 'error', 'message' => 'Invalid request.'], 400);
        }

        $cachedCode = \Illuminate\Support\Facades\Cache::get('otp_' . $request->email);

        if (!$cachedCode || $cachedCode != $request->code) {
            return response()->json(['status' => 'error', 'message' => 'Invalid or expired verification code.'], 400);
        }

        // Success
        \Illuminate\Support\Facades\Cache::forget('otp_' . $request->email);
        $request->session()->forget('2fa_user_id');
        
        Auth::login($user);
        $request->session()->regenerate();

        $redirectUrl = route('home');
        if ($user->isRenter()) {
            $redirectUrl = route('renter.index');
        } elseif ($user->isPropertyManager()) {
            $redirectUrl = route('property_manager.index');
        }

        return response()->json([
            'status' => 'success', 
            'message' => 'Login successful',
            'redirect' => $redirectUrl
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
