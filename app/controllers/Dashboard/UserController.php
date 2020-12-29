<?php

namespace App\Controllers\Dashboard;

use App\Models\User;

class UserController extends DashboardController
{
  public function index()
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
