<?php

// include './class/CRUDDB.php';
class TABLELINKS extends CRUDDB
{
  public function initTableLinks($tableName)
  {
    $this->createTable($tableName);
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