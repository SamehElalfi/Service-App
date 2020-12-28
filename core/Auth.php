<?php

namespace App\Core;

class Auth
{
  /**
   * Check if the user is logged in and the session was started
   */
  public static function is_logged_in()
  {
    if (isset($_SESSION['user']) && isset($_SESSION['logged_in'])) {
      if ($_SESSION['logged_in']) {
        return true;
      }
    }
    return false;
  }

  /**
   * Return the user information as associative array
   */
  public static function get_user()
  {
    if (!self::is_logged_in()) {
      return false;
    }
    return $_SESSION['user'];
  }
}
