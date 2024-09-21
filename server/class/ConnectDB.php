<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');

class ConnectDB
{
  public $conn;
  public $data;

  public function __construct($host, $username, $password, $database)
  {
    // Создание подключения
    $this->conn = new mysqli($host, $username, $password, $database);

    // Проверка подключения
    if ($this->conn->connect_error) {
      die(json_encode(['error' => 'Ошибка подключения: ' . $this->conn->connect_error]));
    }

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
      // Если это preflight-запрос, просто возвращаем 200 OK
      http_response_code(200);
      exit;
    }
    // Обработка POST-запроса
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $this->data = json_decode(file_get_contents('php://input'), true);
    }
  }

  public function getConnection()
  {
    return $this->conn;
  }

  public function closeConnection()
  {
    if ($this->conn) {
      $this->conn->close();
    }
  }

  public function test2()
  {
    echo 'test2 connect';
  }
}