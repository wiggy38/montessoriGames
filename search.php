<?php

require_once 'DbOperation.php';
$db = new DbOperation();

// Call the getGames() method -->
$searchTerm = $_POST["searchTerm"];
$games = $db->findGames($searchTerm);

// Return the results as JSON
header("Content-Type: application/json");
echo json_encode($games);
?>