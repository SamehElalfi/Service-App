<?php

namespace App\Controllers\Auth;

use App\Controllers\Auth\AuthController;
use App\Core\Request;
use App\Models\User;
use App\Core\Auth;

class LoginController extends AuthController
{
  /**
   * Login Form
   */
  public function index()
  {
    if (!Auth::is_logged_in()) {
      return view('Auth/login');
    }

    // If user already logged in 
    Request::redirect('/');
  }


  /**
   * Check for user credentials and start the session
   */
  public function create()
  {
    $request = new Request();
    $params = $request->request['post_params'];

    $user = new User();
    $user_found = $user->where('email', '=', $params['email'])->first();

    // Check if the username and password are correct
    if ($user_found) {
      if (check_bcrypt($params['password'], $user_found['password'])) {
        $this->log_in($user_found);
        Request::redirect("/");
      }
    }

    // If user credentials are wrong
    $request->back();
  }


  /**
   * Logout the user and destroy the session
   */
  public function delete()
  {
    $this->logout();
    Request::redirect("/login");
  }
}
