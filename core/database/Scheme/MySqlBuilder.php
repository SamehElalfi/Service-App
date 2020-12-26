<?php

namespace App\Core\Database\Scheme;

class MySqlBuilder
{

  /**
   * Creates the final sql query
   * 
   * @param array $columns
   * 
   * @return string $sql_query
   */
  public static function build(array $columns, array $foreign_keys): string
  {
    $sql_query = '';

    // build the columns structure
    foreach ($columns as $table_name => $properties) {
      if (!$table_name) {
        $sql_query .= $properties;
        continue;
      }
      $sql_query .= $table_name . " " . $properties;
      $sql_query .= ', ';
    }


    // Add foreign keys to the query
    foreach ($foreign_keys as $key => $value) {
      $sql_query .= $value . ', ';
    }

    // Remove the last comma ,
    $sql_query = substr($sql_query, 0, -2);

    return $sql_query . ");";
  }
}
