<?php
echo 'a';
require_once 'DbOperation.php';
echo 'b';
$db = new DbOperation();
echo 'c';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo 'd';
    $res = $db->updateData($_POST);

    return true;
  }

  echo 'e';
?>