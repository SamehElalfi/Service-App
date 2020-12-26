<?php

namespace App\Core\Database;

class QueryBuilder
{
  protected $pdo;

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  /**
   * Return all rows in a table
   * 
   * @param string $table the table name
   * 
   * @return array|mixed
   */
  public function selectAll(String $table)
  {
    $statement = $this->pdo->prepare("SELECT * FROM {$table}");
    $statement->execute();
    return $statement->fetchAll(\PDO::FETCH_CLASS);
  }
}
