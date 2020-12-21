<?php

class Sells extends migration
{
  function create_table()
  {
    $stmt = $this->connection->prepare("CREATE TABLE sells (
      id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      service_id INT(11) NOT NULL,
      user_id INT(11) NOT NULL,
      coast INT(11) NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      FOREIGN KEY (service_id) REFERENCES services(id),
      FOREIGN KEY (user_id) REFERENCES users(id)
      )");
    $stmt->execute();
    return $stmt;
  }
}
