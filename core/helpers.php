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
   * @return string|void
   */
  function abort($code, String $message = "")
  {
    $path = VIEWS_DIR . '/errors/' . $code . '.php';

    if (file_exists($path)) {
      die(require($path));
    }

    die("Error 500 - " . $message . " & page for error 500 not exists. Please, add it first.");
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
  function view($view, $data = []): void
  {
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
      require_once($path);
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
    global $base_dir;
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
