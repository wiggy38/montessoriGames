<?php
require_once 'DbOperation.php';

$db = new DbOperation();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $res = $db->updateData($_POST);

    return true;
  }
?>