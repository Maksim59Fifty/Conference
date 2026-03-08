<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the main page with student info and links to role subsystems.
     */
    public function index(): View
    {
        return view('home');
    }
}
