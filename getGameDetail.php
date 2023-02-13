<?php
require_once 'DbOperation.php';
$db = new DbOperation();

// Call the getGames() method -->
$id = $_GET["id"];
$game = $db->findGameById($id);
var_dump($game);
// Return the results as JSON
header("Content-Type: application/json");
echo $game;
exit;
?>
