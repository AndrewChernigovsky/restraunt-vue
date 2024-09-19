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
$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'restaurant';

$conn = new mysqli($host, $username, $password, $database);

// Проверяем соединение
if ($conn->connect_error) {
  die("Ошибка подключения: " . $conn->connect_error);
}

$sql = "SELECT name, path FROM linksMenu"; // Настройте имя таблицы по мере необходимости
$result = $conn->query($sql);

$links = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $links[] = $row;
  }
}

echo json_encode($links);
$conn->close();
?>