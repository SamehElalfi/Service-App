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
  $path = VIEWS_DIR . '/pages/' . $view_name . '.php';
  if (!file_exists($path))
    abort(500);
  else
    require_once($path);
}
