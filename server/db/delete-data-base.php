<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

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
  die(json_encode(['error' => 'Ошибка подключения: ' . $conn->connect_error]));
}

// Удаление таблицы linksMenu
$dropTableQuery = "DROP TABLE IF EXISTS linksMenu";

if ($conn->query($dropTableQuery) === TRUE) {
  echo json_encode(['message' => 'Таблица linksMenu успешно удалена.']);
} else {
  echo json_encode(['error' => 'Ошибка удаления таблицы: ' . $conn->error]);
}

$conn->close();
?>