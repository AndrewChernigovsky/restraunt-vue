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

  public function __construct()
  {
    // $isProd = filter_var($prod, FILTER_VALIDATE_BOOLEAN);
    $isProd = false;
    $host = $isProd ? 'localhost' : '127.0.0.1';
    $username = $isProd ? 'u2642915_default' : 'root';
    $password = $isProd ? 'yPIgyj5791pNxJPr' : '';
    $databaseName = $isProd ? 'u2642915_default' : 'restaurant';

    $this->conn = new mysqli($host, $username, $password, $databaseName);

    if ($this->conn->connect_error) {
      die(json_encode(['error' => 'Ошибка подключения: ' . $this->conn->connect_error]));
    }

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
      http_response_code(200);
      exit;
    }

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
}