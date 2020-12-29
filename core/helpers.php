<?php

if (!function_exists('abort')) {
  /**
   * include error page
   * Throw an HttpException with the given data.
   *
   * @param  int  $code the error number
   * @param  string  $message
   * 
   * if the error page not exist, returns string "Error 500 ..."
   * 
   * @return void
   */
  function abort($error_code, String $message = "")
  {
    $path = VIEWS_DIR . '/errors/' . $error_code . '.php';

    if (file_exists($path)) {
      die(require($path));
    }

    throw new \Exception("Error 500 - " . $message .
      " & page for error 500 not exists. Please, add it first.", 1);
  }
}


if (!function_exists('view')) {
  /**
   * include view file from ./views/pages/
   * 
   * @param string $view the file name in ./views/pages/
   * without .php file extension
   * 
   * @param array $data optional array of variable used inside
   * the view file
   * 
   * if file not exists return 500 error page
   * 
   * @return void
   */
  function view($view, $data = [], array $errors = []): void
  {

    // TODO: Create a class for views with methods like "with, withErrors" ...

    // Get Error message and store them in $errors
    // Then remove all error message from the session 
    // so we can add new error message
    if (!is_null($_SESSION['redirect_message'])) {
      $errors = array_merge($errors, $_SESSION['redirect_message']);
      $_SESSION['redirect_message'] = null;
    }

    extract($data);

    $suffix = get_config('view.suffix');
    $prefix = get_config('view.prefix');
    $path = VIEWS_DIR . '/pages/' . $prefix . $view . $suffix;
    if (!file_exists($path))
      abort(500, "View {$view} not exists");
    else
      require_once($path);
  }
}



if (!function_exists('component')) {
  /**
   * include view file from ./views/pages/
   * 
   * @param string $component the file name in ./views/pages/
   * without .php file extension
   * 
   * @param array $data optional array of variable used inside
   * the view file
   * 
   * if file not exists return 500 error page
   * 
   * @return void
   */
  function component($component, $data = []): void
  {
    extract($data);

    $suffix = get_config('view.suffix');
    $prefix = get_config('view.prefix');
    $path = VIEWS_DIR . '/components/' . $prefix . $component . $suffix;
    if (!file_exists($path))
      abort(500, "component {$component} not exists.");
    else
      include($path);
  }
}



if (!function_exists('get_config')) {
  /**
   * return specific value from config files
   * 
   * @param string $key the key of the config you want to get
   * @param mixed $default =null the default value if this function failed to get the $key
   * 
   * @return mixed
   */
  function get_config(String $key, $default = null)
  {
    global $base_dir; // TODO: Remove this variable after check what it does
    $splitted_key = explode('.', $key);
    $value = include(CONFIG_DIR . '/' . $splitted_key[0] . '.php');

    try {
      foreach (array_slice($splitted_key, 1) as $config_name) {
        $value = $value[$config_name];
      }
    } catch (\Throwable $th) {
      return $default;
    }

    return $value;
  }
}


if (!function_exists('env')) {
  /**
   * Gets the value of an environment variable. Supports boolean, empty and null.
   *
   * @param  string  $key
   * @param  mixed   $default
   * @return mixed
   */
  function env($key, $default = null)
  {
    $value = getenv($key);

    if ($value === false) {
      return $default;
    }

    switch (strtolower($value)) {
      case 'true':
      case '(true)':
        return true;

      case 'false':
      case '(false)':
        return false;

      case 'empty':
      case '(empty)':
        return '';

      case 'null':
      case '(null)':
        return;
    }

    if ($value[0] === '"' && $value[-1] === '"') {
      return substr($value, 1, -1);
    }

    return $value;
  }
}


if (!function_exists('bcrypt')) {
  /**
   * Hash the given value against the bcrypt algorithm.
   *
   * @param  string  $value
   * @param  array  $options
   * @return string
   */
  function bcrypt($value, $options = [])
  {
    $hash = password_hash($value, PASSWORD_BCRYPT, [
      'cost' => $options['rounds'] ?? 10,
    ]);

    if ($hash === false) {
      throw new RuntimeException('Bcrypt hashing not supported.');
    }

    return $hash;
  }
}


if (!function_exists('check_bcrypt')) {
  /**
   * Check the given plain value against a hash.
   *
   * @param  string  $value
   * @param  string  $hashedValue
   * @param  array  $options
   * @return bool
   */
  function check_bcrypt($value, $hashedValue)
  {
    if (strlen($hashedValue) === 0) {
      return false;
    }

    return password_verify($value, $hashedValue);
  }
}


if (!function_exists('dd')) {
  /**
   * Dump data and Die
   *
   * @param  mixed ...$vars
   * @return bool
   */
  function dd(...$vars)
  {
    foreach ($vars as $arg) {
      var_dump($arg);
      if (count($vars) > 1) {
        echo "<br>";
      }
    }
    exit(1);
  }
}



if (!function_exists('asset')) {
  /**
   * Return the asset path from public
   *
   * @param  string $path
   * @return bool
   */
  function asset($path)
  {
    $path = trim($path, '/');
    return '/' . $path;
  }
}
