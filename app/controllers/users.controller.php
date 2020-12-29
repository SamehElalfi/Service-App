<?php

namespace App\Controllers;

use App\Models\User;

class Users
{
  public function home()
  {
    $user = new User;
    dd($user->where('id', '>', 1)->first());
    // $pageTitle = 'Hello, Title!';
    // return view('users', compact('pageTitle'));
  }
}
