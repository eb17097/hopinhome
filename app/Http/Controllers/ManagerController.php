<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Display the manager page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('manager.index');
    }
}
