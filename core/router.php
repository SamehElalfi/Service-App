<?php

class Router
{
  /**
   * The main list of routes
   * 
   * @var array
   */
  public $routes = [
    'GET' => [],
    'POST' => []
  ];

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
   * @param string $action the targeted method name
   * 
   * @return bool
   */
  protected function define(String $method, String $route, String $controller, String $action): bool
  {
    // Prefix for all routes
    $prefix = get_config('route.web.prefix');

    $data = array();
    $data["method"] = strtoupper($method);
    $data["route"] = trim($prefix . '/' . $route, '/');
    $data["controller"] = $controller;
    $data["action"] = $action;



    // Make sure the method is correct
    if (!in_array($method, ['GET', 'POST', 'DELETE', 'PUT', 'PATCH']))
      throw new \Exception("Invalid http method");

    $this->routes[$data['method']] += [$data['route'] => $data['controller'] . '@' . $data['action']];

    return true;
  }

  public function direct(String $uri, String $request_type)
  {
    $request_type = strtoupper($request_type);
    if (array_key_exists($uri, $this->routes[$request_type])) {
      $target  = explode('@', $this->routes[$request_type][$uri]);
      $this->call_action(...$target);
      return;
    }
    // print_r($this->routes);
    throw new \Exception("No defined route for this URI({$uri})", 1);
  }


  /**
   * include controller 
   * 
   * @param $controller(str): the name of the controller in ./controllers/
   * without .controller.php file extension
   * 
   * if file not exists return error 500
   * 
   * @return void
   */
  protected function call_action(String $controller, String $action = "index")
  {
    $path = CONTROLLERS_DIR . '/' . $controller . '.controller.php';
    if (!file_exists($path)) {
      abort(500);
    }

    require_once($path);
    return (new $controller)->$action();

    die($controller);
    // return require_once($path);
  }
}
