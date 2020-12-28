<?php

namespace App\Core\Database;

use App\Core\Database\DB;
use ICanBoogie\Inflector;
use App\Core\Database\Connection;
use PDO;

class QueryBuilder extends DB
{

  public function __construct()
  {
    parent::__construct(Connection::make());
    $this->database = get_config('database.connection')[get_config('database.database_type')]['database'];
  }

  public function get($id)
  {
    return $this->where('id', $id);
  }

  public function where(String $column_name, $value = null)
  {
    $query = "SELECT * FROM " . $this->database . ".{$this->get_table_name()} WHERE `{$column_name}` = '{$value}'";
    $statement = $this->exec($query);
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    return $statement->fetch();
  }

  protected function get_table_name()
  {
    if (isset($this->table_name)) {
      return $this->table_name;
    }

    $path = strtolower(get_class($this));
    $class = end(explode('\\', $path));

    $inflector = Inflector::get('en');
    return $inflector->pluralize($class);
  }

  public function insert(array $data)
  {
    // Prepare columns names
    // this variable will be used to insert the values into specific columns
    $columns = '';
    if ($this->has_string_keys($data))
      $columns = '(' . $this->array_to_columns(array_keys($data)) . ')';

    $values = $this->array_to_columns(array_values($data), "'");
    $query = "INSERT INTO " . $this->database . ".{$this->get_table_name()} ";
    $query .= $columns;
    $query .= " VALUES (";

    // Make id Null if no column names
    if (!$columns)
      $query .= "NULL, ";

    $query .= "{$values})";

    // dd($query);
    return $this->exec($query);
  }


  public function delete($id)
  {
    $query = "DELETE FROM " . $this->database . ".{$this->get_table_name()} ";
    $query .= " WHERE id = {$id}";

    // dd($query);
    return $this->exec($query);
  }


  protected function array_to_columns(array $arr, String $splitter = '`')
  {
    $lst = '';
    foreach ($arr as $key) {
      $lst .= $splitter . $key . "{$splitter}, ";
    }
    return substr($lst, 0, -2);
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
