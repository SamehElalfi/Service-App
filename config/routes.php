<?php
class Router
{
  private function split_query_string($query)
  {
    $query = explode('&', $query);
    $params = array();
    foreach ($query as $value) {
      $pair = explode('=', $value);
      $params[$pair[0]] = implode('=', array_slice($pair, 1));
    }
    return $params;
  }

  public function router()
  {
    $r = explode('?', $_SERVER['REQUEST_URI']);
    $request = array();

    $request['uri'] = $_SERVER['REQUEST_URI'];
    $request['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $request['path'] = $r[0];

    // if there is query string
    if (isset($r[1])) {
      $request['full_query'] = "?" . $r[1];
      $request['queries'] = $this->split_query_string($r[1]);
    }
    return $request;
  }
}
