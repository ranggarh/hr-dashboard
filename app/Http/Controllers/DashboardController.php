<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard index page.
     */
    public function index()
    {
        $jobseekerCount = 100; // Replace with actual data
        $assessmentCount = 50; // Replace with actual data
        $progressCount = 30; // Replace with actual data
        return view('dashboard.index', compact('jobseekerCount', 'assessmentCount', 'progressCount'));
    }
}