<?php
include './class/CRUDDB.php';
include './db/TABLELINKS.php';

$tableLinks = "linksMenu";

$database = new CRUDDB('false');

if (isset($_GET['action'])) {
  $database1 = new TABLELINKS('false');
  switch ($_GET['action']) {
    case 'create':
      $database1->initTableLinks($tableLinks);
      break;
    case 'delete':
      $database->deleteTable($tableLinks);
      break;
    case 'addLink':
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
      echo $database->getData($tableLinks);
      break;
    default:
      echo json_encode(['error' => 'Неизвестное действие.']);
  }
} else {
  echo json_encode(['error' => 'Действие не указано.']);
}


?>