<?php

$router->get('', 'index@index');
$router->get('new', 'index@new');
$router->post('new', 'users');
