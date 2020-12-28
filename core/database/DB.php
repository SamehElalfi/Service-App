<?php

namespace App\Core\Database;

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

  public function exec(String $query)
  {
    try {
      $statement = $this->pdo->prepare($query);
      $statement->execute();
      return $statement;
    } catch (PDOException $e) {
      abort(500, $e->getMessage());
    }
  }
}
