<?php

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
  $path = CONTROLLERS_DIR . '/' . $controller_name . '.controller.php';
  if (!file_exists($path))
    abort(500);
  else
    require_once($path);
}
