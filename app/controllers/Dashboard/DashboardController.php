<?php

namespace App\Controllers\Dashboard;

use App\Core\Auth;
use App\Core\Request;
use App\Core\Database\DB;
use App\Models\User;

class DashboardController
{
  public function __construct()
  {
    // Add guard on dashboard pages
    if (!Auth::is_logged_in()) {
      Request::redirect('/login');
    }
  }

  /**
   * The Home page of the dashboard
   */
  public function index()
  {
    $totalUsers = DB::exec("SELECT COUNT(*) FROM users")->fetch()["COUNT(*)"];
    return view('dashboard/index', compact('totalUsers'));
  }
}
