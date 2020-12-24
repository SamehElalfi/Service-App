<?php

namespace App\Controllers;

class Users
{
  public function home()
  {
    $pageTitle = 'Hello, Title!';
    return view('users', compact('pageTitle'));
  }
}
