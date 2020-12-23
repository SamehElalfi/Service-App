<?php

class Router
{
  /**
   * The main list of routes
   * 
   * @var array
   */
  protected $routes = array();

  /**
   * Add new route with GET method
   * 
   * @param string $route the route path
   * @param string $controller the controller name and the the targeted method
   * 
   * @return void
   */
  public function get(String $route, String $controller): void
  {
    $target = $this->split_controller_method($controller);
    if (!$this->define('GET', $route, $target['controller'], $target['method']))
      throw new \Exception("Can't add GET $route", 1);
  }


  /**
   * Add new route with POST method
   * 
   * @param string $route the route path
   * @param string $controller the controller name and the the targeted method
   * 
   * @return void
   */
  public function post(String $route, String $controller): void
  {
    $target = $this->split_controller_method($controller);
    if (!$this->define('POST', $route, $target['controller'], $target['method']))
      throw new \Exception("Can't add POST $route", 1);
  }

  /**
   * Split the controller and the method (e.g. "user@create")
   * 
   * @param string $controller_and_method 
   * 
   * @return array
   */
  protected function split_controller_method(String $controller_and_method)
  {
    $data = $controller_and_method;
    $target = array();

    if (strpos($controller_and_method, '@')) {
      $data = explode('@', $controller_and_method);
      $target['controller'] = $data[0];
      $target['method'] = $data[1];
      return $target;
    }

    $target['controller'] = $data;
    $target['method'] = 'index';
    return $target;
  }


  /**
   * Add new route to the routes list
   * 
   * @param string $method the http method type
   * @param string $route the http route
   * @param string $controller the controller name
   * @param string $targeted_method the targeted method name
   * 
   * @return bool
   */
  protected function define(String $method, String $route, String $controller, String $targeted_method): bool
  {
    // Prefix for all routes
    $prefix = get_config('route.web.prefix');

    $data = array();
    $data["method"] = strtoupper($method);
    $data["route"] = trim($prefix . '/' . $route, '/');
    $data["controller"] = $controller;
    $data["targeted_method"] = $targeted_method;


    // Make sure the method is correct
    if (!in_array($method, ['GET', 'POST', 'DELETE', 'PUT', 'PATCH']))
      throw new \Exception("Invalid http method");

    $key = $data['method'] . " " . $data['route'];
    $this->routes[$key] = $data;

    return true;
  }

  public function direct(String $uri, String $method = 'GET')
  {
    $key = $method . ' ' . $uri;
    if (array_key_exists($key, $this->routes)) {
      controller($this->routes[$key]['controller']);
      return;
    }
    // print_r($this->routes);
    throw new \Exception("No defined route for this URI({$uri})", 1);
  }
}
