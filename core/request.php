<?php

namespace App\Core;

class Request
{
  public $request = [];
  public static $message = '';

  public function __construct()
  {
    $this->request = $this->prepare_request();
  }

  /**
   * Parse the request into an array 
   * 
   * @return array
   */
  protected function prepare_request()
  {
    $request = array();

    // URI (e.g. /public/index.php?param=string&name=another-string)
    $request['uri'] = $_SERVER['REQUEST_URI'];

    $auth = $this->make_request_auth();

    // Full URL
    // e.g. https://username:password@localhost:8080/public/index.php?param=string&name=another-string#some-fragment
    $request['full_url'] = $_SERVER['REQUEST_SCHEME'] . '://' .
      $request['full_auth'] . $_SERVER['HTTP_HOST'] . $request['uri'];

    $parsed_url = $this->parse_request_url($request['full_url']);

    $request = array_merge($request, $auth, $parsed_url);

    return $request;
  }

  /**
   * Add username(string), password(string) and auth(bool) to 
   * $request variable
   * 
   * @return array
   */
  protected function make_request_auth(): array
  {
    $request = [];
    if (isset($_SERVER['PHP_AUTH_USER'])) {
      $request['auth'] = true;
      $request['username'] = $_SERVER['PHP_AUTH_USER'];
      $request['password'] = $_SERVER['PHP_AUTH_PW'];
      $request['full_auth'] = $request['username'] . ':' . $request['password'];
    } else {
      $request['auth'] = false;
      $request['username'] = null;
      $request['password'] = null;
      $request['full_auth'] = null;
    }
    return $request;
  }

  /**
   * parse the url and add its components to $request
   * 
   * @param string $full_url the full link
   * (e.g. https://username:password@localhost:8080/public/index.php?param=string&name=another-string#some-fragment)
   * 
   * @return array
   */
  protected function parse_request_url(String $full_url): array
  {
    $request = [];
    $url = parse_url($full_url);

    // Request Method GET, POST ...
    $request['method'] = $_SERVER['REQUEST_METHOD'];

    // The previous URL
    $request['referer'] = $_SERVER['HTTP_REFERER'];

    // HTTP | HTTPS
    $request['protocol'] = $url['scheme'];

    // Authentication username and password
    $request['user'] = $url['user'];
    $request['pass'] = $url['pass'];

    // Domain Name (e.g localhost, www.google.com)
    $request['host'] = $url['host'];

    // Port (int) (e.g. 80, 8080)
    $request['port'] = $url['port'];

    // /public/index.php
    $request['path'] = $url['path'];
    $request['trimmed_path'] = trim($url['path'], '/');

    // param=string&name=another-string
    $request['query'] = $url['query'];

    // Full Query (e.g. ?param=string&name=another-string)
    // $request['full_query'] = "?" . $request['query'];

    // some-fragment
    $request['fragment'] = $url['fragment'];

    // Queries (e.g. ['param'=>'string', 'name'=>'another-string'])
    $request['get_params'] = $_GET;
    $request['post_params'] = $_POST;

    return $request;
  }


  /**
   * return the current URI without additional slashes /
   * 
   * @return string
   */
  public static function uri()
  {
    return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
  }

  public static function back($redirect_message = null)
  {
    $previous_url = $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : '/';
    $instance = new static;
    $instance::redirect($previous_url, $redirect_message);
  }

  public static function redirect(String $path, $redirect_message = null)
  {
    if (!is_null($redirect_message)) {
      $_SESSION['redirect_message'][] = $redirect_message;
    }
    header("Location: {$path}");
  }
}
