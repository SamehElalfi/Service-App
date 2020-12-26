<?php

namespace App\Core\Database;

use App\Core\Database\Scheme\Table;
use App\Core\Database\Scheme\MySqlBuilder;

class Migration extends Table
{
  public string $sql_query = '';

  /**
   * Build the final sql query for the right database type
   * 
   * @return void
   */
  protected function build(): void
  {
    if (get_config('database.database_type') == 'mysql') {
      $this->sql_query = MySqlBuilder::build($this->columns, $this->foreign_keys);
    }
  }

  /**
   * Entry point to create a new table with columns' names and types
   * 
   * @param string $table the name of the table
   * @param callback $callback a callback function that create columns
   * 
   * @return void
   */
  public function create(String $table, $callback): void
  {
    $this->table = $table;
    $this->columns[] = "CREATE TABLE `{$table}` (";
    $callback($this);
    $this->build();
  }
}
