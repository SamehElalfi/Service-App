<?php

namespace App\Core\Database;

class Migration
{
  public String $table;
  public array $columns;
  public string $sql = '';

  public function set_table($table)
  {
    $this->table = $table;
  }

  protected function build()
  {
    foreach ($this->columns as $key => $value) {
      if (gettype($value) == 'array') {
        $this->sql .= "`{$key}` ";
        foreach ($value as $v) {
          $this->sql .= "{$v} ";
        }
        $this->sql .= ',';
      } else {
        $this->sql .= $value;
      }
      $this->sql .= '<br>';
    }
  }

  public function create(String $table, $callback)
  {
    $this->columns[] = "CREATE TABLE `{$table}` (";
    $callback($this);
    $this->columns[] = ");";
    $this->build();
  }

  public function string($column, Int $length = 255)
  {
    $this->columns[$column] = "VARCHAR({$length})";
    return $this;
  }

  public function nullable(bool $value = true)
  {
    $nullable = $value ? 'NULL' : 'NOT NULL';
    $last_column = $this->last_column();
    $this->columns[$last_column] = [$this->columns[$last_column], $nullable];
    return $this;
  }
  protected function last_column()
  {
    return array_key_last($this->columns);
  }
}

/**
 * 
 * $column = [
 * 
 *  'name' => ['varchar', 'not null]
 * 
 * ]
 */
