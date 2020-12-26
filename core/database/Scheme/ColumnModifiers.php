<?php

namespace App\Core\Database\Scheme;

use App\Core\Database\Scheme\ColumnTypes;

class ColumnsModifiers extends ColumnTypes
{
  public function nullable(bool $value = true)
  {
    $nullable = $value ? 'NULL' : 'NOT NULL';
    $last_column = array_key_last($this->columns);
    $this->columns[$last_column] = $this->columns[$last_column] . " " . $nullable;
    return $this;
  }
  public function primary(bool $value = true)
  {
    $primary = $value ? 'PRIMARY KEY' : '';
    $last_column = array_key_last($this->columns);
    $this->columns[$last_column] = $this->columns[$last_column] . " " . $primary;
    return $this;
  }
}
