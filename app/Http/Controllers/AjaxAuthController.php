<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use App\Mail\OTPCode;

class AjaxAuthController extends Controller
{
    /**
     * Check if a user exists by email.
     */
    public function checkEmail(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $exists = User::where('email', $request->email)->exists();

        return response()->json([
            'exists' => $exists,
        ]);
    }

    /**
     * Send an OTP code to the provided email address.
     */
    public function sendOtp(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $code = random_int(100000, 999999);

        Cache::put('otp_' . $request->email, $code, 600); // 10 minutes

        try {
            Mail::to($request->email)->send(new OTPCode($code));
            return response()->json(['status' => 'success', 'message' => 'Verification code sent.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to send email. Please try again.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Verify the provided OTP code.
     */
    public function verifyOtp(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6',
        ]);

        $cachedCode = Cache::get('otp_' . $request->email);

        if (!$cachedCode || $cachedCode != $request->code) {
            return response()->json(['status' => 'error', 'message' => 'Invalid or expired verification code.'], 400);
        }

        Cache::forget('otp_' . $request->email);

        return response()->json(['status' => 'success', 'message' => 'Email verified successfully.']);
    }

    /**
     * Register a new user after email verification.
     */
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'country' => 'nullable|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $redirectUrl = route('home');

        if ($user->isRenter()) {
            $redirectUrl = route('renter.index');
        } elseif ($user->isPropertyManager()) {
            $redirectUrl = route('property_manager.index');
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Registration successful',
            'redirect' => $redirectUrl,
        ]);
    }
}
