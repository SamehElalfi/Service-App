<?php

class Users extends migration
{
  function create_table()
  {
    $stmt = $this->connection->prepare("CREATE TABLE users  (
      id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      first_name VARCHAR(30) NOT NULL,
      last_name VARCHAR(30) NOT NULL,
      email VARCHAR(255) NOT NULL,
      password VARCHAR(40) NOT NULL,
      balance INT(11) DEFAULT 0,
      role INT(2) DEFAULT 2,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      FOREIGN KEY (role) REFERENCES roles(id)
      )");
    $stmt->execute();
    return $stmt;
  }
}
