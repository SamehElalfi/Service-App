<?php

namespace App\Core\Database;

use App\Core\Database\QueryBuilder;

class Model extends QueryBuilder
{
  public function find($id)
  {
    $this->where($id);
    return $this;
  }
}
