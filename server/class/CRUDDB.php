<?php

include 'ConnectDB.php';

class CRUDDB extends ConnectDB
{
  public function createTable($tableCreationQuery, $tableName)
  {
    // Создание таблицы
    if ($this->getConnection()->query($tableCreationQuery) !== TRUE) {
      echo json_encode(['error' => 'Ошибка создания таблицы: ' . $this->getConnection()->error]);
      exit;
    }

    // Проверка наличия данных
    if ($this->data) {
      // Вставка данных в таблицу
      foreach ($this->data as $newItem) {
        if (isset($newItem['name']) && isset($newItem['path'])) {
          // Проверка на существование записи
          $stmt = $this->getConnection()->prepare("SELECT COUNT(*) FROM $tableName WHERE name = ? AND path = ?");
          $stmt->bind_param("ss", $newItem['name'], $newItem['path']);
          $stmt->execute();
          $stmt->bind_result($count);
          $stmt->fetch();

          if ($count == 0) {
            // Если записи не существует, вставляем новую запись
            $stmt = $this->getConnection()->prepare("INSERT INTO $tableName (name, path) VALUES (?, ?)");
            $stmt->bind_param("ss", $newItem['name'], $newItem['path']);

            if ($stmt->execute()) {
              echo json_encode(['message' => 'Запись успешно добавлена!']);
            } else {
              echo json_encode(['error' => 'Ошибка при добавлении записи: ' . $stmt->error]);
            }
          } else {
            echo json_encode(['message' => 'Запись с такими значениями уже существует.']);
          }
        } else {
          echo json_encode(['error' => 'Некорректные данные: name или path отсутствуют.']);
        }
      }
    } else {
      echo json_encode(['error' => 'Нет данных для вставки.']);
    }

    // Закрытие соединения
    $this->closeConnection();
  }
}
?>