<?php

/**
 * include view file from ./views/pages/
 * 
 * @param $view_name(str): the file name in ./views/pages/
 * without .php file extension
 * 
 * if file not exists return 500 error page
 * 
 * @return void
 */
function view($view_name): void
{
  $path = './views/pages/' . $view_name . '.php';
  if (!file_exists($path))
    abort(500);
  else
    require_once($path);
}

/**
 * include error page
 * 
 * @param $err(int): the error number
 * 
 * if the error page not exist, returns string "Error 500 ..."
 * 
 * @return void
 */
function abort($err): void
{
  $path = './views/errors/' . $err . '.php';
  if (!file_exists($path)) {
    if ($err == 500)
      return "Error 500 - Server Error";
    abort(500);
  } else
    require_once($path);
}

/**
 * include controller 
 * 
 * @param $controller_name(str): the name of the controller in ./controllers/
 * without .controller.php file extension
 * 
 * if file not exists return error 500
 * 
 * @return void
 */
function controller($controller_name): void
{
  $path = './controllers/' . $controller_name . '.controller.php';
  if (!file_exists($path))
    abort(500);
  else
    require_once($path);
}
