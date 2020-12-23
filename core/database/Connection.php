<?php
class Connection
{
  public static function make()
  {
    try {
      $config = get_config('database.connection.mysql');
      $driver = $config['driver'];
      $host = $config['host'];
      $port = $config['port'];
      $database = $config['database'];
      $username = $config['username'];
      $password = $config['password'];
      $options = $config['options'];

      return new PDO(
        "{$driver}:host={$host}:{$port};{$database}",
        $username,
        $password,
        $options
      );
    } catch (PDOException $e) {
      die("Could not to connect: " .  $e->getMessage());
    }
  }
}
