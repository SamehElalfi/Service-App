<?php

namespace App\Controllers\Dashboard;

use App\Models\User;

class FreelancerController extends DashboardController
{
  public function home()
  {
    $user = new User;
    dd($user->where('id', '>', 1)->first());
    // $pageTitle = 'Hello, Title!';
    // return view('users', compact('pageTitle'));
  }

  public function create()
  {
    # code...
  }
}
