<?php

// include './class/CRUDDB.php';
class TABLELINKS extends CRUDDB
{
  public function initTableLinks($tableName)
  {
    $newFields = [
      'name VARCHAR(255) NOT NULL',
      'path VARCHAR(255) NOT NULL'
    ];

    $this->createTable($tableName);
    $this->createTableFields($tableName, $newFields);
  }
  public function insertIntoTable($tableName, $data)
  {
    $this->createTable($tableName);

    foreach ($data as $link) {
      $this->createDataFields($tableName, $link);
    }
  }
}
?>