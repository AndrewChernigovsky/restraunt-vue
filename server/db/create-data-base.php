<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  // Если это preflight-запрос, просто возвращаем 200 OK
  http_response_code(200);
  exit;
}

// Настройки подключения к базе данных
$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'restaurant';

// Создание подключения
$conn = new mysqli($host, $username, $password, $database);

// Проверка подключения
if ($conn->connect_error) {
  die("Ошибка подключения: " . $conn->connect_error);
}

// Создание таблицы linksMenu, если она не существует
$tableCreationQuery = "
CREATE TABLE IF NOT EXISTS linksMenu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    path VARCHAR(255) NOT NULL
)";

if ($conn->query($tableCreationQuery) !== TRUE) {
  echo json_encode(['error' => 'Ошибка создания таблицы: ' . $conn->error]);
  exit;
}

// Обработка POST-запроса
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Получение данных из POST-запроса
  $data = json_decode(file_get_contents('php://input'), true);

  // Проверяем, что данные были получены правильно
  if ($data) {
    // Подготовка SQL-запроса для проверки существующих записей
    $existingRecords = [];
    foreach ($data as $item) {
      if (isset($item['name']) && isset($item['path'])) {
        // Проверяем существование записи
        $stmt = $conn->prepare("SELECT COUNT(*) FROM linksMenu WHERE name = ? AND path = ?");
        $stmt->bind_param("ss", $item['name'], $item['path']);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        if ($count == 0) {
          // Если записи не существует, добавляем ее в массив для вставки
          $existingRecords[] = $item;
        }
        $stmt->close();
      }
    }

    // Вставка новых записей в таблицу
    if (!empty($existingRecords)) {
      $stmt = $conn->prepare("INSERT INTO linksMenu (name, path) VALUES (?, ?)");
      foreach ($existingRecords as $newItem) {
        $stmt->bind_param("ss", $newItem['name'], $newItem['path']);
        $stmt->execute();
      }
      $stmt->close();
      echo json_encode(['message' => 'Новые данные успешно вставлены!']);
    } else {
      echo json_encode(['message' => 'Все записи уже существуют.']);
    }
  } else {
    echo json_encode(['error' => 'Некорректные данные']);
  }
} else {
  http_response_code(405); // Метод не разрешен
  echo json_encode(['error' => 'Метод не разрешен']);
}

$conn->close();
?>