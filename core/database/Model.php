<?php

namespace App\Core\Database;

use App\Core\Database\QueryBuilder;

class Model extends QueryBuilder
{
  public function find($id)
  {
    // TODO: Make find able to get multiple rows
    $this->where($id);
    return $this;
  }

  public function insert(array $data)
  {
    // add all columns to the model
    $this->addColumns(array_keys($data));
    $this->addBindings(array_values($data));

    $query = $this->makeInsert();
    try {
      return $this->runQuery($query);
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function delete()
  {
    $query = $this->makeDelete();

    try {
      return $this->runQuery($query);
    } catch (\Throwable $th) {
      return false;
    }
  }
}
