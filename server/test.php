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
    case 'addLink':
      $database1 = new TABLELINKS($host, $username, $password, $databaseName);
      $database1->initTableLinks($tableLinks);
      if (isset($_GET['name']) && isset($_GET['path'])) {
        $name = $_GET['name'];
        $path = $_GET['path'];
        $database->addLink($tableLinks, $name, $path);

      } else {
        echo json_encode(['error' => 'нет имени или пути']);
      }
      break;
    case 'deleteLink':
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $database->deleteLink($tableLinks, $id);
      } else {
        echo json_encode(['error' => 'ID не указан.']);
      }
      break;
    case 'links':
      $database1 = new TABLELINKS($host, $username, $password, $databaseName);
      $database1->insertIntoTable($tableName, $data);
      echo $database->getData($tableLinks);
      break;
    default:
      echo json_encode(['error' => 'Неизвестное действие.']);
  }
} else {
  echo json_encode(['error' => 'Действие не указано.']);
}


?>