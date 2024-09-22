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
      id INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(255) NOT NULL,
      path VARCHAR(255) NOT NULL
    )";

    if ($this->getConnection()->query($tableCreationQuery) !== TRUE) {
      echo json_encode(['error' => 'Ошибка создания таблицы: ' . $this->getConnection()->error]);
      exit;
    } else {
      $this->getConnection()->query($tableCreationQuery);
    }
  }
  public function deleteTable($tableName)
  {
    $tableCreationQuery = "
    DROP TABLE IF EXISTS $tableName";

    $this->getConnection()->query($tableCreationQuery);
    $this->closeConnection();
  }
  public function createDataFields($tableName, $fields)
  {
    $addFieldsQuery = "ALTER TABLE $tableName ";
    $fieldDefinitions = [];

    foreach ($fields as $field) {
      $fieldDefinitions[] = "INSERT ADD INTO $tableName VALUES ($field)";
    }

    $addFieldsQuery .= implode(", ", $fieldDefinitions);
    echo $addFieldsQuery;

    if ($this->getConnection()->query($addFieldsQuery) !== TRUE) {
      echo json_encode(['error' => 'Ошибка добавления полей: ' . $this->getConnection()->error]);
      exit;
    } else {
      echo json_encode(['message' => 'Поля успешно добавлены.']);
    }
  }

  public function getData($tableName)
  {
    if ($this->getConnection()->connect_error) {
      die("Ошибка подключения: " . $this->getConnection()->connect_error);
    }

    $sql = "SELECT id, name, path FROM $tableName";
    $result = $this->getConnection()->query($sql);

    $links = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $links[] = $row;
      }
    }

    echo json_encode($links);
  }

  public function addLink($tableName, $name, $path)
  {
    $insertQuery = "INSERT INTO $tableName (name, path) VALUES (?, ?)";

    $stmt = $this->getConnection()->prepare($insertQuery);
    if ($stmt === false) {
      echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $this->getConnection()->error]);
      exit;
    }

    $stmt->bind_param("ss", $name, $path);

    if ($stmt->execute() === TRUE) {
      echo json_encode(['message' => 'Запись успешно добавлена.']);
    } else {
      echo json_encode(['error' => 'Ошибка добавления записи: ' . $stmt->error]);
    }

    $stmt->close();
  }
  public function deleteLink($tableName, $id)
  {
    $deleteQuery = "DELETE FROM $tableName WHERE id = ?";

    $stmt = $this->getConnection()->prepare($deleteQuery);
    if ($stmt === false) {
      echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $this->getConnection()->error]);
      exit;
    }

    // Привязка параметра id
    $stmt->bind_param("i", $id); // Предполагаем, что id - это целое число

    // Выполнение запроса
    if ($stmt->execute() === TRUE) {
      echo json_encode(['message' => 'Запись успешно удалена.']);
    } else {
      echo json_encode(['error' => 'Ошибка удаления записи: ' . $stmt->error]);
    }
  }
}
?>