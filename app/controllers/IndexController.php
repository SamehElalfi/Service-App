<?php

namespace App\Controllers;

use App\Core\Database\Migration;
use App\Core\Request;
use App\Models\User;
use App\Core\Auth;

class IndexController
{
  public function index()
  {

    if (Auth::is_logged_in()) {
      dd("I am Logged In as ", Auth::get_user());
    }

    // $user = new User();
    // $data = $user->get(1)['email'];
    // $first_name = 'mohammed';
    // $last_name = 'fahmy';
    // $email = "mohammed.fahmy@gmail.com";
    // $password = "147258";

    // // dd($data, [$data, $data], 123, false, true);
    // $data = [
    //   "first_name" => "Mohammed",
    //   "last_name" => 'fahmy',
    //   "email" => "mohammed.fahmy@gmail.com",
    //   "password" => bcrypt("123456")
    // ];
    // // dd($user->insert(array_values($data)));
    // dd($user->delete(5));

    // view('index');
    // echo "Hello from new class";
  }

  public function scheme()
  {
    $migration = new Migration();
    $migration->create("users", function ($table) {
      $table->string('name')->nullable()->primary();
      $table->string('email', 22)->nullable(true);
      $table->string('email2', 22)->nullable(false);
      $table->foreignId(['roles', 'id']);
    });
    echo $migration->sql_query;
  }
  public function regex()
  {
    // $m = preg_match("/users\/(?P<id>..*?)\/profile\/(?P<name>..*?)\/edit$/", $route, $matches);

    // The original route that created by developer
    $route = trim("/users/{id}/profile/{name}/edit/", '/');

    // convert this route to regex pattern
    $pattern = preg_replace("/({.*?})/", "(..*?)", $route);

    // replace slashes / with \/
    $pattern = '/' . str_replace('/', '\/', $pattern) . '$/';
    // die(var_dump($pattern));


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
    $route = '/' . str_replace('/', '\/', $route) . '$/';

    preg_match($route, 'users/1/profile/sameh/edit', $matches);
    var_dump($matches);
  }
  public function home($params)
  {
    // var_dump($re);
    echo "{$params['name']} has the ID: {$params['id']}";
  }
}
