Basic PHP framework for lightweight websites. This project is for learning purposes only.

I tried to make this framework be like Laravel structure (The same way Eloquent, MVC Structure, Config files, ... etc).

# Pros

Here is a list of all pros that I made in this project:

- MVC Design Pattern
- Clear File Structure
- Basic Route System for main request types (GET, POST, PUT, PATCH DELETE)
- Autoloaded classes with Composer
- Config files with the ability of get environment variables
- Friendly Errors pages
- Basic Auth System (Login, Register, Middleware)
- You can redirect to a route with a message or an error

# Getting Started

## Installing

You can choose one of the next method to start the project:

### Docker

This is the easiest way to start the project with no setup required. Just install docker and run this command in your terminal:
`docker-compose up -d`
Note: This command will make mysql directory inside the project. Here all your database are exist. Don't delete this directory unless you want to remove all databases with all data inside them.

Then inside 'Serviceapp_web' container run this command to install all required packages:
`composer install`
This is it. Now, You are ready to go.

### Setup Apache, PHP, and MySQL

If you want, You can install all dependencies by yourself manually or using a tool like WAMP, LAMP, or XAMPP.
Start you server and run this command to install all required packages:
`composer install`

# Documentation

## Creating new models or containers

If you created any new controllers or models you need to include them first by running this command: `composer dump-autoload`

## Routes
To make new routes add it inside ./App/Routes/web.php file with this syntax

  ```
  $router->get('/your/route/is/here/{variable}', 'SomethingController');
  $router->post('/another/route/{variable}/{anotherVariable}', 'SomethingController@method');
  ```
The default method name is index. So, you don't have to write it at all.

## Controllers
all controllers classes should have the same namespace which is `App\Controllers`

## Views
you can pass a view from any controller with the helper function `view(string $viewName, [array $variable, [string $errorMessage]])`
```
view('dir/viewName', [optional $errorMessage])
```

all views should be inside `./App/Views/Pages/` and the components inside `./App/View/Components/`

You can include components inside your views by using the helper function `component(string $componentName, [array $variables])`
```
component('dir/to/componentName', ['variable1'=>'Value1'])
```

You can set custom error pages by adding the view inside `./App/Views/Errors/` and the view name should be **the status code** (404, 500, .. etc)

## Models
all model must extend `App\Core\Database\Model`
all models have ready-to-use methods like (find, where, first, get, all, count, ... etc)

You can execute custom SQL query by using `App\Core\Database\DB::exec(string $query, [array $bindings])` which returns `PDOStatement` class.

# Author

- Sameh A. Elalfi [Sameh.elalfi.mail@gmail.com](mailto:sameh.elalfi.mail@gmail.com)
