<?php
include './class/CRUDDB.php';

$tableName = 'linksMenu';
$tableCreationQuery = "
CREATE TABLE IF NOT EXISTS linksMenu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    path VARCHAR(255) NOT NULL
)";

// Настройки подключения к базе данных
$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'restaurant';

// Создание подключения
$database = new CRUDDB($host, $username, $password, $database);

// Создание таблицы
$database->createTable($tableCreationQuery, $tableName);
?>