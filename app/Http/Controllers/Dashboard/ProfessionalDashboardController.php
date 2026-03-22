<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\AgentInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ProfessionalDashboardController extends Controller
{
    /**
     * Display the professional dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $listings = $user->listings()->latest()->get();
        
        return view('dashboard.index', compact('listings'));
    }

    /**
     * Display the business owner agents page.
     */
    public function agents()
    {
        $user = Auth::user();
        $agents = $user->agents()->latest()->paginate(10);
        
        return view('dashboard.agents', compact('agents'));
    }

    /**
     * Send an invitation to an agent.
     */
    public function sendInvite(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'licenseNumber' => 'nullable|string|max:255',
            'listingLimit' => 'nullable|integer|min:0',
            'boostLimit' => 'nullable|integer|min:0',
        ]);

        $user = Auth::user();

        // Create the "invited" agent user
        $agent = User::create([
            'name' => $request->fullName,
            'email' => $request->email,
            'password' => bcrypt(Str::random(16)), // Placeholder password
            'role' => 'business_agent',
            'business_owner_id' => $user->id,
            'status' => 'invited',
            'listing_limit' => $request->listingLimit,
            'boost_limit' => $request->boostLimit,
            'onboarding_step' => 2,
        ]);

        // Generate a signed URL for acceptance
        $invitationUrl = URL::temporarySignedRoute(
            'invitation.accept',
            now()->addDays(7),
            ['email' => $agent->email]
        );

        // Send the invitation email
        Mail::to($agent->email)->send(new AgentInvitation($agent->name, $invitationUrl));

        return response()->json([
            'success' => true,
            'message' => 'Invitation sent successfully to ' . $agent->email,
        ]);
    }

    /**
     * Display the professional profile page.
     */
    public function profile()
    {
        return view('dashboard.profile');
    }

    /**
     * Display the business owner settings page.
     */
    public function businessSettings()
    {
        return view('dashboard.business-settings');
    }

    /**
     * Display the business owner security page.
     */
    public function businessSecurity()
    {
        return view('dashboard.business-security');
    }

    /**
     * Display the professional security page.
     */
    public function security()
    {
        return view('dashboard.security');
    }
}
