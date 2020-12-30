<?php

return [

  /**
   * Database Connection
   */

  'connection' => [
    'mysql' => [
      'driver' => 'mysql',
      'host' => env('DB_HOST', 'db'), // add your server here
      'port' => env('DB_PORT', '3306'),
      'database' => env('DB_DATABASE', 'serviceapp_db'), // Your Database Name
      'username' => env('DB_USERNAME', 'username'), // Database Username
      'password' => env('DB_PASSWORD', 'password'), // Database Password
      'fetch_obj' => true,
      'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 60 * 5 // 5 minutes
      ]
    ]
  ],
  'database_type' => strtolower(env('DB_TYPE', 'mysql'))
];
