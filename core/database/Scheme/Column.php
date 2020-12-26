<?php

namespace App\Core\Database\Scheme;

class Columns
{
  public array $columns;
  public array $foreign_keys;

  protected function add_column(String $column, String $value)
  {
    $this->columns[$column] = $value;
  }
  protected function add_foreign_key(String $column, array $references, String $on_update = 'RESTRICT', String $on_delete = 'RESTRICT')
  {
    $reference_table = $references[0];
    $reference_column = $references[1];

    $query = "FOREIGN KEY ({$column}) REFERENCES ";
    $query .= "{$reference_table}({$reference_column}) ";

    // Check if ON DELETE & ON UPDATE are set
    $reference_options = ['RESTRICT', 'NO ACTION', 'CASCADE', 'SET NULL', 'SET DEFAULT'];
    if ($on_delete != '') {
      $on_delete  = in_array(
        strtoupper($on_delete),
        $reference_options
      ) ? $on_delete : $reference_options[0];

      $query .= "ON DELETE {$on_delete} ";
    }

    if ($on_update != '') {
      $on_update  = in_array(
        strtoupper($on_update),
        $reference_options
      ) ? $on_update : $reference_options[0];
      $query .= "ON UPDATE {$on_update} ";
    }


    $this->foreign_keys[] = $query;
  }
}
