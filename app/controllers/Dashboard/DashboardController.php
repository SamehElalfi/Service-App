<?php

namespace App\Controllers\Dashboard;

class DashboardController
{
  public function index()
  {
    $totalUsers = 15;
    $totalFreelancers = 150;
    return view('dashboard/index', compact('totalUsers', 'totalFreelancers'));
  }
}
