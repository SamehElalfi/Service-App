<?php

namespace App\Controllers\Auth;

use App\Core\Auth;
use App\Core\Request;
use App\Models\User;

class Register extends AuthController
{
  /**
   * Return the view of registration page if the no user logged in
   */
  public function index()
  {
    if (Auth::is_logged_in()) {
      return Request::redirect('/');
    }
    return view('auth/register');
  }

  /**
   * Create new user and logged him in
   */
  public function create()
  {
    $request = new Request();
    $params = $request->request['post_params'];
    $params['password'] = bcrypt($params['password']);

    $user = new User();
    $user_inserted = $user->insert($params);

    $this->log_in($params);
    return Request::redirect('/');
  }
}
