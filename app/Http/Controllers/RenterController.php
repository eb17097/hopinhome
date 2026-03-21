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

    /**
     * Display the renter security page.
     */
    public function security()
    {
        return view('renter.security');
    }

    /**
     * Mark the renter setup checklist as complete.
     */
    public function markSetupComplete(Request $request)
    {
        $user = $request->user();
        
        $user->update([
            'setup_checklist_completed' => true
        ]);

        return response()->json(['status' => 'success']);
    }
}
