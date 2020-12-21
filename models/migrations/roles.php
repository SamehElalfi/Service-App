<?php

class Roles extends migration
{
  function create_table()
  {
    $stmt = $this->connection->prepare("CREATE TABLE roles (
      id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      role_name VARCHAR(30) NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      )");
    $stmt->execute();
    return $stmt;
  }
}
