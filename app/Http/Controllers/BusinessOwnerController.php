<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessOwnerController extends Controller
{
    /**
     * Display the business owner dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $listings = Auth::user()->listings()->latest()->get();
        return view('business_owner.dashboard', compact('listings'));
    }

    /**
     * Display the business owner security page.
     */
    public function security()
    {
        return view('business_owner.security');
    }

    /**
     * Display the business owner profile page.
     */
    public function profile()
    {
        return view('business_owner.profile');
    }
}
