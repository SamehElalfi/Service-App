<?php

class Request
{
  public $request = [];

  public function __construct()
  {
    $this->request = $this->prepare_request();
  }

  /**
   * Convert the query string into associated array
   * ['param'=>'string', 'name'=>'another-string']
   * 
   * @param $query(str): the full string of the http query
   * 
   * @return array
   */
  protected function split_query_string($query): array
  {
    $params = array();

    // Split the query string into array
    $query = explode('&', $query);

    // Make this array dictionary ($key and $value)
    foreach ($query as $value) {
      $pair = explode('=', $value);
      $params[$pair[0]] = implode('=', array_slice($pair, 1));
    }

    return $params;
  }

  /**
   * 
   */
  protected function prepare_request()
  {
    $r = explode('?', $_SERVER['REQUEST_URI']);
    $request = array();

    // URI (e.g. /public/index.php?param=string&name=another-string)
    $request['uri'] = $_SERVER['REQUEST_URI'];

    $request['protocol'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
    $request['host'] = $_SERVER['HTTP_HOST'];
    $request['path'] = $r[0];

    // Full URL (e.g. https://localhost/public/index.php?param=string&name=another-string)
    $request['full_url'] = $request['protocol'] . "://$request[host]$request[uri]";


    // if there is query string
    if (isset($r[1])) {
      // Full Query (e.g. ?param=string&name=another-string)
      $request['full_query'] = "?" . $r[1];

      // Queries (e.g. ['param'=>'string', 'name'=>'another-string'])
      $request['queries'] = $this->split_query_string($r[1]);
    }
    return $request;
  }


  /**
   * return the current URI without additional slashes /
   * 
   * @return string
   */
  public static function uri()
  {
    return trim($_SERVER['REQUEST_URI'], '/');
  }
}
