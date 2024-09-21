<?php
include './class/CRUDDB.php';
include './db/TABLELINKS.php';

$tableLinks = "linksMenu";

$host = '127.0.0.1';
$username = 'root';
$password = '';
$databaseName = 'restaurant';

$database = new CRUDDB($host, $username, $password, $databaseName);

if (isset($_GET['action'])) {
  switch ($_GET['action']) {
    case 'create':
      $database->createTable($tableLinks);
      break;
    case 'delete':
      $database->deleteTable($tableLinks);
      break;
    case 'links':
      $database1 = new TABLELINKS($host, $username, $password, $databaseName);
      $database1->initTableLinks($tableLinks);
      // $database1->initTableLinks($tableLinks);
      $database1->insertIntoTable($tableLinks, ['Главная', '/']);
      break;
    default:
      echo json_encode(['error' => 'Неизвестное действие.']);
  }
} else {
  echo json_encode(['error' => 'Действие не указано.']);
}


?>