<?php

namespace App\Core\Database\Scheme;

use App\Core\Database\Scheme\Columns;

class ColumnTypes extends Columns
{

  // TODO: add the rest of SQL data types
  // TODO: Move every data types to its class (Create new one for every type)

  public function char($column, Int $length = 1)
  {
    $length = $this->minmax($length, 0, 255);
    $this->add_column($column, "CHAR({$length})");
    return $this;
  }
  public function string($column, Int $length = 255)
  {
    $length = $this->minmax($length, 0, 65535);
    $this->add_column($column, "VARCHAR({$length})");
    return $this;
  }
  public function tinyText($column)
  {
    $this->add_column($column, "TINYTEXT");
    return $this;
  }
  public function text($column, Int $length = 65535)
  {
    $length = $this->minmax($length, 0, 65535);
    $this->add_column($column, "TEXT({$length})");
    return $this;
  }








  public function bit($column, Int $length = 1)
  {
    $length = $this->minmax($length, 0, 64);
    $this->add_column($column, "BIT({$length})");
    return $this;
  }
  public function tinyInt($column, Int $length = 255)
  {
    $length = $this->minmax($length, 0, 255);
    $this->add_column($column, "TINYINT({$length})");
    return $this;
  }
  public function bool($column)
  {
    $this->add_column($column, "BOOL");
    return $this;
  }
  public function boolean($column)
  {
    $this->bool("BOOL");
    return $this;
  }
  public function smallInt($column, Int $length = 255)
  {
    $length = $this->minmax($length, 0, 255);
    $this->add_column($column, "SMALLINT({$length})");
    return $this;
  }
  public function mediumInt($column, Int $length = 255)
  {
    $length = $this->minmax($length, 0, 255);
    $this->add_column($column, "MEDIUMINT({$length})");
    return $this;
  }
  public function int($column, Int $length = 255)
  {
    $length = $this->minmax($length, 0, 255);
    $this->add_column($column, "INT({$length})");
    return $this;
  }
  public function integer($column, Int $length = 255)
  {
    $this->int($column, $length);
    return $this;
  }
  public function bigInt($column, Int $length = 255)
  {
    $length = $this->minmax($length, 0, 255);
    $this->add_column($column, "BIGINT({$length})");
    return $this;
  }








  public function date($column)
  {
    $this->add_column($column, "DATE");
    return $this;
  }
  public function time($column)
  {
    $this->add_column($column, "TIME");
    return $this;
  }
  public function datetime($column)
  {
    $this->add_column($column, "DATETIME");
    return $this;
  }
  public function timestamp($column)
  {
    $this->add_column($column, "TIMESTAMP");
    return $this;
  }
  public function year($column)
  {
    $this->add_column($column, "YEAR");
    return $this;
  }









  public function foreignId(array $references, String $on_update = '', String $on_delete = '')
  {
    $this->add_foreign_key("id", $references, $on_update, $on_delete);
    return $this;
  }














  /**
   * Return the value of it's in specific range 
   * or return the min or max range
   * 
   * @param int $value
   * @param int $min
   * @param int $max
   * 
   * @return int
   */
  protected function minmax(Int $value, Int $min, Int $max): int
  {
    if ($value <= $min) return $min;
    if ($value >= $max) return $max;
    return $value;
  }
}
