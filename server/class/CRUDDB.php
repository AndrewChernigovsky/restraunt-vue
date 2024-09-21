<?php

include 'ConnectDB.php';

class CRUDDB extends ConnectDB
{

  public $tableCreationQuery;
  public $tableName;

  public function createTable($tableName)
  {
    $tableCreationQuery = "
    CREATE TABLE IF NOT EXISTS $tableName (
      id INT AUTO_INCREMENT PRIMARY KEY
    )";

    if ($this->getConnection()->query($tableCreationQuery) !== TRUE) {
      echo json_encode(['error' => 'Ошибка создания таблицы: ' . $this->getConnection()->error]);
      exit;
    } else {
      $this->getConnection()->query($tableCreationQuery);
    }

    $this->closeConnection();
  }
  public function deleteTable($tableName)
  {
    $tableCreationQuery = "
    DROP TABLE IF EXISTS $tableName";

    $this->getConnection()->query($tableCreationQuery);
    $this->closeConnection();
  }
  public function createTableFields($tableName, $fields)
  {
    $addFieldsQuery = "ALTER TABLE $tableName ";
    $fieldDefinitions = [];

    foreach ($fields as $field) {
      $fieldDefinitions[] = "ADD COLUMN $field";
    }

    $addFieldsQuery .= implode(", ", $fieldDefinitions);

    if ($this->getConnection()->query($addFieldsQuery) !== TRUE) {
      echo json_encode(['error' => 'Ошибка добавления полей: ' . $this->getConnection()->error]);
      exit;
    } else {
      echo json_encode(['message' => 'Поля успешно добавлены.']);
    }
  }
}
?>