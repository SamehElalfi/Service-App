<?php

/**
 * include error page
 * 
 * @param $err(int): the error number
 * 
 * if the error page not exist, returns string "Error 500 ..."
 * 
 * @return string|void
 */
function abort($err)
{
  $path = VIEWS_DIR . '/errors/' . $err . '.php';
  if (!file_exists($path)) {
    if ($err == 500)
      return "Error 500 - Server Error";
    abort(500);
  } else
    require_once($path);
}
