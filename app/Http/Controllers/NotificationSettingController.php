<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationSettingController extends Controller
{
    /**
     * Update the user's notification settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'push_enabled' => 'required|boolean',
            'email_enabled' => 'required|boolean',
            'marketing_enabled' => 'required|boolean',
            'announcements_enabled' => 'required|boolean',
            'newsletter_enabled' => 'required|boolean',
        ]);

        $user = Auth::user();
        
        $settings = $user->notificationSettings()->updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return response()->json([
            'message' => 'Notification preferences updated successfully.',
            'settings' => $settings
        ]);
    }
}
