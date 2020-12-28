<?php

namespace App\Controllers\Auth;

class AuthController
{

  /**
   * Setup the session and add the user information to it
   */
  protected function log_in(array $user)
  {
    $_SESSION['logged_in'] = true;
    $_SESSION['user'] = $user;

    // Remove the password from the session
    unset($_SESSION['user']['password']);

    return true;
  }

  /**
   * Logout the user and delete the session
   */
  protected function logout()
  {
    unset($_SESSION['user']);
    unset($_SESSION['logged_in']);

    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();
    return true;
  }
}
