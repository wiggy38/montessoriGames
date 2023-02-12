<?php

class DbOperation
{
    private $conn;
 
    function __construct()
    {
        require_once dirname(__FILE__) . '/Constants.php';
        require_once dirname(__FILE__) . '/DbConnect.php';
        $db = new DbConnect();
        $this->conn = $db->connect();
    }
 
    /*
    * The create operation
    * When this method is called a new record is created in the database
    */
    function createGame($description, $game_type, $age_range, $skill_developped, $how_to_play, $materials_needed, $difficulty_score)
    {
        $stmt = $this->conn->prepare("INSERT INTO games (description, game_type, age_range, skill_developped, how_to_play, materials_needed, difficulty_score) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $description, $game_type, $age_range, $skill_developped, $how_to_play, $materials_needed, $difficulty_score);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
 
    /*
    * The read operation
    * When this method is called it is returning all the existing records in the database
    */
    function getGames()
    {
        $stmt = $this->conn->prepare("SELECT id, name, description, game_type, age_range, skill_developped, how_to_play, materials_needed, difficulty_score FROM games");
        $stmt->execute();
        $stmt->bind_result($id, $name, $description, $game_type, $age_range, $skill_developped, $how_to_play, $materials_needed, $difficulty_score);
 
        $games = array();
 
        while ($stmt->fetch()) {
            $game = array();
            $game['id'] = $id;
            $game['name'] = $name;
            $game['description'] = $description;
            $game['game_type'] = $game_type;
            $game['age_range'] = $age_range;
            $game['skill_developped'] = $skill_developped;
            $game['how_to_play'] = $how_to_play;
            $game['materials_needed'] = $materials_needed;
            $game['difficulty_score'] = $difficulty_score;
            array_push($games, $game);
        }
 
        return $games;
    }

     
    /*
    * The read operation
    * When this method is called it is returning all the existing records in the database
    */
    function findGames($searchTerm)
    {

        $query = "SELECT id, name, description, game_type, age_range, skill_developped, how_to_play, materials_needed, difficulty_score 
                    FROM games 
                    WHERE name LIKE ? OR description LIKE ? OR game_type LIKE ?";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Statement preparation failed: " . $this->conn->error);
        }

        $searchTermValue = "%" . $searchTerm . "%";
        $stmt->bind_param("sss", $searchTermValue, $searchTermValue, $searchTermValue);
        if (!$stmt->execute()) {
            die("Statement execution failed: " . $stmt->error);
        }
        $stmt->bind_result($id, $name, $description, $game_type, $age_range, $skill_developped, $how_to_play, $materials_needed, $difficulty_score);
 
        $games = array();
 
        while ($stmt->fetch()) {
            $game = array();
            $game['id'] = $id;
            $game['name'] = $name;
            $game['description'] = $description;
            $game['game_type'] = $game_type;
            $game['age_range'] = $age_range;
            $game['skill_developped'] = $skill_developped;
            $game['how_to_play'] = $how_to_play;
            $game['materials_needed'] = $materials_needed;
            $game['difficulty_score'] = $difficulty_score;
            array_push($games, $game);
        }
 
        return $games;
    }

     
    /*
    * The read operation
    * When this method is called it is returning all the existing records in the database
    */
    function findGamesByAgeRange($ageRange)
    {

        $query = "SELECT id, name, description, game_type, age_range, skill_developped, how_to_play, materials_needed, difficulty_score 
                    FROM games 
                    WHERE age_range LIKE ?";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Statement preparation failed: " . $this->conn->error);
        }

        $searchTermValue = "%" . $ageRange . "%";
        $stmt->bind_param("s", $searchTermValue);
        if (!$stmt->execute()) {
            die("Statement execution failed: " . $stmt->error);
        }
        $stmt->bind_result($id, $name, $description, $game_type, $age_range, $skill_developped, $how_to_play, $materials_needed, $difficulty_score);
 
        $games = array();
 
        while ($stmt->fetch()) {
            $game = array();
            $game['id'] = $id;
            $game['name'] = $name;
            $game['description'] = $description;
            $game['game_type'] = $game_type;
            $game['age_range'] = $age_range;
            $game['skill_developped'] = $skill_developped;
            $game['how_to_play'] = $how_to_play;
            $game['materials_needed'] = $materials_needed;
            $game['difficulty_score'] = $difficulty_score;
            array_push($games, $game);
        }
 
        return $games;
    }

    function getRandomQuote($lang)
    {

        $query = "SELECT quote FROM montessori_quotes WHERE language = ? ORDER BY RAND() LIMIT 1";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Statement preparation failed: " . $this->conn->error);
        }

        $stmt->bind_param("s", $lang);
        if (!$stmt->execute()) {
            die("Statement execution failed: " . $stmt->error);
        }
        $stmt->bind_result($quote);
 
        $stmt->fetch();

        return $quote;

    }

    
    function findGameById($lang)
    {

        $query = "SELECT * FROM games LIMIT 5";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Statement preparation failed: " . $this->conn->error);
        }

        //$stmt->bind_param("s", $lang);
        if (!$stmt->execute()) {
            die("Statement execution failed: " . $stmt->error);
        }
        $stmt->bind_result($id, $name, $description, $game_type, $age_range, $skill_developped, $how_to_play, $materials_needed, $difficulty_score);
 
        $stmt->fetch();

        $games = array();
 
        while ($stmt->fetch()) {
            $game = array();
            $game['id'] = $id;
            $game['name'] = $name;
            $game['description'] = $description;
            $game['game_type'] = $game_type;
            $game['age_range'] = $age_range;
            $game['skill_developped'] = $skill_developped;
            $game['how_to_play'] = $how_to_play;
            $game['materials_needed'] = $materials_needed;
            $game['difficulty_score'] = $difficulty_score;
            array_push($games, $game);
        }

        return $games[0];

    }



}

?>