<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyManagerController extends Controller
{
    /**
     * Display the property manager dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $listings = Auth::user()->listings()->latest()->get();
        return view('property_manager.dashboard', compact('listings'));
    }

    /**
     * Display the property manager security page.
     */
    public function security()
    {
        return view('property_manager.security');
    }
}
