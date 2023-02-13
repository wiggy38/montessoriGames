<?php
require_once 'DbOperation.php';
$db = new DbOperation();

// Call the getGames() method -->
$id = $_GET["id"];
$game = $db->findGameById($id);

// Return the results as JSON
header("Content-Type: application/json");
echo json_encode($game);
?>
