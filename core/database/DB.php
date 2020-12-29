<?php

namespace App\Core\Database;

use App\Core\Database\Connection;
use PDO;
use PDOException;

class DB
{
  protected $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  protected function has_string_keys(array $array)
  {
    return count(array_filter(array_keys($array), 'is_string')) > 0;
  }

  /**
   * Execute query using PDO. If error occurred, then return 500 error
   * with the Execution message
   * 
   * @return PDOStatement|false
   */
  public static function exec(String $query, array $bindings = [])
  {
    $db = new static(Connection::make());
    try {
      $statement = $db->pdo->prepare($query);
      $statement->setFetchMode(PDO::FETCH_ASSOC);
      $statement->execute($bindings);
      return $statement;
    } catch (PDOException $e) {
      abort(500, $e->getMessage());
    }
  }
}
