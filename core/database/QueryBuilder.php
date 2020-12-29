<?php

namespace App\Core\Database;

use App\Core\Database\DB;
use ICanBoogie\Inflector;
use App\Core\Database\Connection;
use PDO;
use PDOStatement;

class QueryBuilder extends DB
{

  /**
   * The table name. this can be changed in the model
   * 
   * @var string
   */
  protected string $table;

  /**
   * The primary key in the table
   * 
   * @var string
   */
  public string $primaryKey = 'id';

  /**
   * All where statements are stored here and will be used to build the query
   * 
   * @var array
   */
  protected array $wheres = [];

  /**
   * Here are all bindings that will be add to the PDO executor
   * Bindings are used in PDO to avoid SQL Injection
   * 
   * @var array
   */
  protected array $bindings = [];

  /**
   * Valid operators for where statements
   * 
   * @var array
   */
  private array $operators = ['=', '>', '>=', '<', '<=', 'in'];

  /**
   * The columns will be selected in regular select statement
   * 
   * @var array
   */
  protected array $columns = ['*'];


  /**
   * Return the primary key of the table
   */
  public function getPrimaryKey()
  {
    return $this->primaryKey;
  }



  public function __construct()
  {
    parent::__construct(Connection::make());
    $this->database = get_config('database.connection')[get_config('database.database_type')]['database'];
  }

  /**
   * Make the SQL query and execute it, then fetch all rows from the result
   * of this execution
   * 
   * @param array|string $columns
   * pass columns names to select these column only
   * 
   * @return array
   */
  public function get($columns = null)
  {
    // Assume that the $column is actually an array of column
    // So, We need to select these columns only
    if (!is_null($columns)) {
      $this->addColumns($columns);
    }

    $query = $this->makeSelect();
    return $this->fetchAll($this->runSelect($query));
  }

  /**
   * Creates SQL Query of wheres and bindings
   * 
   * @return string
   */
  protected function makeSelect()
  {
    $query = "SELECT {$this->prepareColumns()} FROM {$this->getTable()}";

    // If there is one or more where statements
    if ($this->prepareWheres()) {
      $query .= $this->prepareWheres();
    }
    return $query;
  }

  /**
   * Run SQL SELECT statement and return the PDO statement
   * 
   * @param $query
   * 
   * @return PDOStatement|false
   */
  protected function runSelect(String $query)
  {
    return DB::exec($query, $this->getBindings());
  }

  /**
   * return array of associative arrays of rows
   * 
   * @param PDOStatement $statement
   * 
   * @return array|false
   */
  protected function fetchAll(PDOStatement $statement)
  {
    // pass the fetched rows to a collection class
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * return associative array of the first fetch row
   * 
   * @param PDOStatement $statement
   * 
   * @return array|false
   */
  protected function fetch(PDOStatement $statement)
  {
    // pass the fetched rows to a collection class
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * return associative arrays of the first fetched row
   * 
   * @param PDOStatement $statement
   * 
   * @return array|false
   */
  public function first($columns = null)
  {
    // Assume that the $column is actually an array of column
    // So, We need to select these columns only
    if (!is_null($columns)) {
      $this->addColumns($columns);
    }

    $query = $this->makeSelect();
    return $this->fetch($this->runSelect($query));
  }

  /**
   * Return all bindings
   * 
   * @return array
   */
  protected function getBindings()
  {
    return $this->bindings;
  }

  /**
   * Prepare the structure of the selected columns to be used in SQL query
   * the columns should be like "(name, age, address)" or just "*"
   * 
   * @return string
   */
  protected function prepareColumns()
  {
    // If there more than one column, loop over them and add them in 
    // a set as string e.g. (name, age, address)
    if (count($this->columns) > 1) {
      $columns = '';
      foreach ($this->columns as $column) {
        $columns .= $column;

        // If this column is the last one, don't add comma ',' at the end
        if ($column !== end($this->columns)) {
          $columns .= ", ";
        }
      }

      return $columns;
    }

    // If the selected columns are only one column, then return it
    return $this->columns[0];
  }

  /**
   * Add the given columns as the selected columns
   * 
   * @return void
   */
  protected function addColumns($columns)
  {
    if (gettype($columns) == 'array') {
      foreach ($columns as $column) {
        $this->addColumn($column);
      }
    } else {
      // Assume the developer add single column (as string) to this array by mistake
      // then the developer expect to everything works just fine
      $this->addColumn($columns);
    }
  }

  /**
   * Add new column to the selected columns
   * 
   * @param string $column
   * 
   * @return void
   */
  protected function addColumn(String $column)
  {
    // If this is the first column add to the selected columns
    // remove star from columns array
    if ($this->columns == ['*']) {
      $this->columns = [];
      $this->columns[] = $column;
      return;
    }

    // If this column didn't add already, then add it
    if (!in_array($column, $this->columns)) {
      $this->columns[] = $column;
      return;
    }
  }

  /**
   * Prepare the structure of all WHERE statements to be used in SQL query
   * 
   * @return string
   */
  protected function prepareWheres()
  {
    // If there more than one where statement, loop over them and add them in 
    // a string to be look like "WHERE id = ? and WHERE age >= 18"
    $wheres = ' WHERE ';
    foreach ($this->wheres as $index => $where) {
      $wheres .= "{$where['column']} {$where['operator']} ?";

      // If this where is the last one, don't add comma ',' at the end
      if ($index !== array_key_last($this->wheres)) {
        $boolean = strtoupper($where['boolean']);
        $wheres .= " {$boolean} ";
      }
    }

    return $wheres;
  }

  /**
   * Add conditional WHERE statement to the query
   * 
   * @return App\Core\Database\QueryBuilder
   */
  public function where(String $column, $operator = '=',  $value = null, $boolean = 'and')
  {

    // Assume that the developer want to make query like this (where id = $value)
    // and passed nothing to this array but $id. So, We need to get the primary key
    // and select rows by it
    if (func_num_args() == 1) {
      list($column, $value) = array($this->getPrimaryKey(), $column);
      $this->where($column, $operator, $value, $boolean);
    }


    // Assume that the developer passed only the column and the value 
    // so the default operator would be "="
    elseif (func_num_args() == 2) {
      list($value, $operator) = array($operator, '=');
      $this->where($column, $operator, $value, $boolean);
    }


    // Assume there is a full where statement created by the developer
    // So, We need to check if the operator is valid or not. And if not, 
    // assume the developer made the operator to be "="
    else {
      if (!in_array($operator, $this->operators)) {
        $operator = '=';
      }
      $this->addWhere($column, $operator, $value, $boolean);
    }

    return $this;
  }

  /**
   * Add where statement to be used when build the query
   * 
   * @param string $column
   * @param string $operator
   * @param $value
   * @param $boolean
   * 
   * @return void
   */
  protected function addWhere(String $column, $operator = '=', $value = null, $boolean = 'and')
  {
    $this->wheres[] = compact('column', 'operator', 'value', 'boolean');

    // Bindings will be used in PDO to avoid SQL Injection
    $this->bindings[] = $value;
  }

  /**
   * Return the table name of this model
   * 
   * @return string
   */
  protected function getTable()
  {
    // Assume that the developer changed the name of the table
    // by setting $table in his model
    if (isset($this->table)) {
      return $this->table;
    }

    // The default table name will be the plural of the model name
    // So, We need to get the model name first by splitting its path
    // $path = strtolower(get_class($this));
    // $model = end(explode('\\', $path));

    // Inflector helps us to pluralize any word
    // including the model name of course
    $inflector = Inflector::get('en');
    // return $inflector->pluralize($model);

    $class = is_object($this) ? get_class($this) : $this;
    return $inflector->pluralize(basename(str_replace('\\', '/', $class)));
  }
}
