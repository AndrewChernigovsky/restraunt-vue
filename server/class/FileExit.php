<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
class FileExit
{
  public function __construct($filePath, $fileName)
  {
    if (file_exists($filePath)) {
      header('Content-Type: application/json');
      header('Content-Disposition: attachment filename=' . $fileName);
      header('Content-Length: ' . filesize($filePath));

      readfile($filePath);
      exit;
    } else {
      http_response_code(404);
      echo json_encode(['error' => 'File not found']);
    }
  }
}
?>