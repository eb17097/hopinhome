<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RenterController extends Controller
{
    /**
     * Display the renter dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('renter.dashboard');
    }
}
