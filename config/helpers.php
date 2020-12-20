<?php
function view($view_name)
{
  $path = './views/pages/' . $view_name . '.php';
  if (!file_exists($path))
    abort(404);
  else
    require_once($path);
}

function abort($err)
{
  include_once('./views/errors/' . $err . '.php');
}

function controller($controller_name)
{
  $path = './controllers/' . $controller_name . '.controller.php';
  if (!file_exists($path))
    abort(500);
  else
    require_once($path);
}
