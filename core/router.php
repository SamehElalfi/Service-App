<?php

namespace App\Core;

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
    if (!$this->add_route('GET', $route, $target['controller'], $target['method']))
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
    if (!$this->add_route('POST', $route, $target['controller'], $target['method']))
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
   * @param string $controller the targeted method name
   * 
   * @return bool
   */
  protected function add_route(String $method, String $route, String $controller, String $controller_method): bool
  {
    $data = array();
    $data["method"] = strtoupper($method);
    $data["route"] = $route;
    $data["controller"] = $controller;
    $data["controller_method"] = $controller_method;

    // Make sure the method is correct
    if (!in_array($method, ['GET', 'POST', 'DELETE', 'PUT', 'PATCH']))
      throw new \Exception("Invalid http method");

    $key = $data['method'] . " " . $data['route'];
    $this->routes[$key] = $data;

    return true;
  }
}
