<?php

class Services extends migration
{
  function create_table()
  {
    $stmt = $this->connection->prepare("CREATE TABLE services (
      id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      description TEXT NOT NULL,
      coast INT(11) DEFAULT 0,
      active BOOLEAN DEFAULT true,
      user_id INT(11) NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      FOREIGN KEY (user_id) REFERENCES users(id)
      )");
    $stmt->execute();
    return $stmt;
  }
}
