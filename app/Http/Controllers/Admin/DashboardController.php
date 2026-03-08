<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with links to user and conference management.
     */
    public function index(): View
    {
        return view('admin.index');
    }
}
