<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropertyManagerController extends Controller
{
    /**
     * Display the property manager dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('property_manager.dashboard');
    }
}
