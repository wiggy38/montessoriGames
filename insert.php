<?php

require_once 'DbOperation.php';
$db = new DbOperation();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $res = $db->updateData($_POST);
    }else{
        $res = $db->insertData($_POST);
    }
    return true;
  }

?>