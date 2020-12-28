<?php

return [

  /**
   * Database Connection
   */

  'connection' => [
    'mysql' => [
      'driver' => 'mysql',
      'host' => env('DB_HOST', 'db'),
      'port' => env('DB_PORT', '3306'),
      'database' => env('DB_DATABASE', 'serviceapp_db'),
      'username' => env('DB_USERNAME', 'username'),
      'password' => env('DB_PASSWORD', 'password'),
      'fetch_obj' => true,
      'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 60 * 5 // 5 minutes
      ]
    ]
  ],
  'database_type' => strtolower(env('DB_TYPE', 'mysql'))
];
