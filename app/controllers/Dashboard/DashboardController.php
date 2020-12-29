<?php

namespace App\Controllers\Dashboard;

use App\Core\Auth;
use App\Core\Request;

class DashboardController
{
  public function __construct()
  {
    // Add guard on dashboard pages
    if (!Auth::is_logged_in()) {
      // Request::redirect('/login');
    }
  }

  /**
   * The Home page of the dashboard
   */
  public function index()
  {
    $totalUsers = 15;
    $totalFreelancers = 150;
    return view('dashboard/index', compact('totalUsers', 'totalFreelancers'));
  }
}
