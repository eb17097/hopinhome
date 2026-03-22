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
        return view('dashboard.profile');
    }

    /**
     * Display the professional security page.
     */
    public function security()
    {
        return view('dashboard.security');
    }
}
