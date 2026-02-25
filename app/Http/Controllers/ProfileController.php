<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // Only fill fields that were actually sent and validated
        $user->fill($request->safe()->only(['name', 'email', 'bio']));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profiles', 's3');
            $user->profile_photo_url = \Illuminate\Support\Facades\Storage::disk('s3')->url($path);
        }

        $user->save();

        $statusMessage = $request->hasFile('photo') ? 'profile-photo-updated' : 'profile-updated';

        if ($request->filled('redirect_to')) {
            return Redirect::to($request->input('redirect_to'))->with('status', $statusMessage);
        }

        return Redirect::back()->with('status', $statusMessage);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
