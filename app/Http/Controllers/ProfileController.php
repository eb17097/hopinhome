<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
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
            // Using public disk for local development consistency unless S3 is explicitly required
            $disk = config('filesystems.default') === 's3' ? 's3' : 'public';
            $path = $request->file('photo')->store('profiles', $disk);
            $user->profile_photo_url = Storage::disk($disk)->url($path);
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
    public function destroy(Request $request)
    {
        $confirmationPhrase = 'Delete my account';

        if ($request->expectsJson()) {
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'confirmation' => ['required', 'string', 'regex:/^' . $confirmationPhrase . '$/i'],
            ], [
                'confirmation.regex' => 'Please type "' . $confirmationPhrase . '" exactly to confirm.'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }
        } else {
            $request->validate([
                'confirmation' => ['required', 'string', 'regex:/^' . $confirmationPhrase . '$/i'],
            ]);
        }

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'redirect' => route('home')
            ]);
        }

        return Redirect::to('/');
    }
}
