<?php
class TABLELINKS extends CRUDDB
{

  public function initTableLinks($tableName)
  {
    $newFields = [
      "name VARCHAR(255) NOT NULL",
      "path VARCHAR(255) NOT NULL"
    ];

    $this->createTable($tableName);
    $this->createTableFields($tableName, $newFields);
  }

  public function insertIntoTable($tableName, $name, $path)
  {
    $insertQuery = "INSERT INTO $tableName (name, path) VALUES (?, ?)";

    // Подготовка запроса
    $stmt = $this->getConnection()->prepare($insertQuery);
    if ($stmt === false) {
      echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $this->getConnection()->error]);
      exit;
    }

    // Привязка параметров
    $stmt->bind_param("ss", $name, $path);

    // Выполнение запроса
    if ($stmt->execute() === TRUE) {
      echo json_encode(['message' => 'Данные успешно добавлены.']);
    } else {
      echo json_encode(['error' => 'Ошибка добавления данных: ' . $stmt->error]);
    }

    // Закрытие запроса
    $stmt->close();
  }
}
?>