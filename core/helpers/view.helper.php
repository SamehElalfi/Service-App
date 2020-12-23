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
  $suffix = get_config('views.suffix');
  $prefix = get_config('views.prefix');
  $path = VIEWS_DIR . '/pages/' . $prefix . $view_name . $suffix;
  if (!file_exists($path))
    abort(500);
  else
    require_once($path);
}
