<?php

namespace App\Core;

use App\Core\Request;

class Router
{
  /**
   * The main list of routes
   * 
   * @var array
   */
  public $routes = [
    'GET' => [],
    'POST' => [],
    'PUT' => [],
    'PATCH' => [],
    'DELETE' => []
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
   * Add new route with PUT method
   * 
   * @param string $route the route path
   * @param string $controller the controller name and the the targeted method
   * 
   * @return void
   */
  public function put(String $route, String $controller): void
  {
    $target = $this->split_controller_method($controller);
    if (!$this->define('PUT', $route, $target['controller'], $target['method']))
      throw new \Exception("Can't add PUT $route", 1);
  }


  /**
   * Add new route with PATCH method
   * 
   * @param string $route the route path
   * @param string $controller the controller name and the the targeted method
   * 
   * @return void
   */
  public function patch(String $route, String $controller): void
  {
    $target = $this->split_controller_method($controller);
    if (!$this->define('PATCH', $route, $target['controller'], $target['method']))
      throw new \Exception("Can't add PATCH $route", 1);
  }

  /**
   * Add new route with DELETE method
   * 
   * @param string $route the route path
   * @param string $controller the controller name and the the targeted method
   * 
   * @return void
   */
  public function delete(String $route, String $controller): void
  {
    $target = $this->split_controller_method($controller);
    if (!$this->define('DELETE', $route, $target['controller'], $target['method']))
      throw new \Exception("Can't add DELETE $route", 1);
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
    $data["route"] = $this->route_to_regex($prefix . '/' . $route);
    $data["controller"] = $controller;
    $data["action"] = $action;

    // Make sure the method is correct
    if (!in_array($method, ['GET', 'POST', 'DELETE', 'PUT', 'PATCH']))
      throw new \Exception("Invalid http method");

    $this->routes[$data['method']] += [$data['route'] => $data['controller'] . '@' . $data['action']];

    return true;
  }

  /**
   * Direct the request to the correct route
   * 
   * @param string $uri The request uri
   * @param string $request_type the method used to make the request GET,POST...
   * 
   */
  public function direct(String $uri, String $request_type)
  {
    $request_type = strtoupper($request_type);
    $patters = array_keys($this->routes[$request_type]);

    if ($uri == '') {
      $pattern = $this->route_to_regex($uri);
      $target  = explode('@', $this->routes[$request_type][$pattern]);
      $controller = $target[0];
      $action = $target[1];
      $this->call_action($controller, $action, []);
    } else {
      foreach ($patters as $pattern) {
        if ($pattern == '/$/') continue;
        $same = preg_match($pattern, $uri, $matches);
        if ($same) {
          $target  = explode('@', $this->routes[$request_type][$pattern]);
          $controller = $target[0];
          $action = $target[1];
          $matches = $this->remove_integer_indexes($matches);
          $this->call_action($controller, $action, $matches);
          return;
        }
      }
      abort(404, "Are you lost?");
    }
  }


  /**
   * include controller 
   * 
   * @param string $controller the name of the controller in ./controllers/
   * without .controller.php file extension
   * @param string $action the method name
   * @param array $params all parameters that passed to the method
   * if file not exists return error 500
   * 
   * @return void
   */
  protected function call_action(String $controller, String $action = "index", $params = []): void
  {
    $controller_path = $controller;
    $path = CONTROLLERS_DIR . '/' . $controller_path . '.php';
    if (!file_exists($path)) {
      abort(500, "Controller {$controller} not exists.");
    }

    $controller = str_replace('/', '\\', $controller);
    $controller = "\App\Controllers\\" . $controller;

    // Call method from class
    (new $controller)->$action($params);
  }

  /**
   * Convert the route into regex to match the request uri
   * 
   * @param string $route
   * 
   * @return string
   */
  protected function route_to_regex(String $route): String
  {
    // Remove additional slashes from the beginning and the end
    $route = trim($route, '/');

    // convert this route to regex pattern
    $pattern = preg_replace("/({.*?})/", "(..*?)", $route);

    // replace slashes / with \/
    $pattern = '/' . str_replace('/', '\/', $pattern) . '$/';

    // Convert the parameters to regex group names
    preg_match($pattern, $route, $matches);
    $m = array_slice($matches, 1);

    foreach ($m as $route_param) {
      $route_param_without_brackets = substr($route_param, 1, -1);

      $replace = '(?P<' . $route_param_without_brackets . '>..*?)';

      // replace the route parameters to regex patterns
      $route = str_replace($route_param, $replace, $route);
    }

    // replace slashes / with \/
    return '/' . str_replace('/', '\/', $route) . '$/';
  }

  /**
   * remove duplicated elements from merged arrays (associative+indexed)
   * 
   * @param array $arr
   * 
   * @return array
   */
  protected function remove_integer_indexes(array $arr)
  {
    $new_arr = [];
    foreach ($arr as $key => $value) {
      if (gettype($key) != "integer") $new_arr[$key] = $value;
    }
    return $new_arr;
  }
}
