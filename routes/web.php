<?php

// return [
//   '' => 'index@index',
//   'new' => 'index@new',
//   'public' => 'index'
// ];
$router->get('', 'index@index');
$router->get('new', 'index@new');
// $router->get('public', 'index');
