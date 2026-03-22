<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Display the professional profile page.
     */
    public function profile()
    {
        $user = Auth::user();
        
        if ($user->isBusinessOwner()) {
            return view('business_owner.profile');
        }
        
        return view('property_manager.profile');
    }

    /**
     * Display the professional security page.
     */
    public function security()
    {
        $user = Auth::user();
        
        if ($user->isBusinessOwner()) {
            return view('business_owner.security');
        }
        
        return view('property_manager.security');
    }
}
