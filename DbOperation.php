<?php

class DbOperation
{
    private $conn;
 
    function __construct()
    {
        echo '/Constants.php';
        require_once dirname(__FILE__) . '/Constants.php';
        require_once dirname(__FILE__) . '/DbConnect.php';
        echo '/DbConnect.php';
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
                    WHERE name LIKE ?";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Statement preparation failed: " . $this->conn->error);
        }

        $searchTermValue = "%" . $searchTerm . "%";
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
            $utf8_game = array_map('utf8_encode', $game);
            array_push($games, $utf8_game);
        }

        return $games;
    }
     
    /*
    * The read operation
    * When this method is called it is returning all the existing records in the database
    */
    function getRandomFeaturedGames()
    {

        $query = "SELECT id, name, description, game_type, age_range, skill_developped, how_to_play, materials_needed, difficulty_score 
                    FROM games 
                    ORDER BY RAND() 
                    LIMIT 5";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Statement preparation failed: " . $this->conn->error);
        }

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
                    
            // Extract the min_age and max_age from the age_range string
            $min_age = (int) substr($ageRange, 0, 1);
            $max_age = (int) substr($ageRange, 2, 1);


        $query = "SELECT id, name, description, game_type, age_range, skill_developped, how_to_play, materials_needed, difficulty_score ";
        $query .= "FROM games ";
        $query .= "WHERE min_age <= ? ";
        $query .= ($max_age>0) ? "OR max_age >= ?" : "";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Statement preparation failed: " . $this->conn->error);
        }

        $stmt->bind_param("ss", $min_age, $max_age);
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

    
    function findGameById($id)
    {
        $query = "SELECT * FROM games WHERE id = ?";
        $stmt = $this->conn->prepare($query);
    
        if (!$stmt) {
            die("Statement preparation failed: " . $this->conn->error);
        }
    
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            die("Statement execution failed: " . $stmt->error);
        }
        $stmt->bind_result($id, $name, $description, $game_type, $min_age, $max_age, $age_range, $skill_developped, $how_to_play, $materials_needed, $difficulty_score);
     
        $stmt->fetch();
    
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
        $utf8_game = array_map('utf8_encode', $game);
    
        return $utf8_game;
    }
    
    
    function updateAges()
{
    $select_query = "SELECT id, age_range FROM games";
    $update_query = "UPDATE games SET min_age = ?, max_age = ? WHERE id = ?";
    
    $stmt = $this->conn->prepare($select_query);
    $stmt->execute();
    $stmt->bind_result($id, $age_range);
    
    while ($stmt->fetch()) {
        $min_age = intval($age_range[0]);
        $max_age = intval($age_range[2]);
        
        $update_stmt = $this->conn->prepare($update_query);
        $update_stmt->bind_param("iii", $min_age, $max_age, $id);
        $update_stmt->execute();
    }
}

    function updateAgeRange() {
        // Get all the rows in the games table
        $query = "SELECT id, age_range FROM games";
        $stmt = $this->conn->prepare($query);
    
        if (!$stmt) {
            die("Statement preparation failed: " . $this->conn->error);
        }
        
        if (!$stmt->execute()) {
            die("Statement execution failed: " . $stmt->error);
        }
        $stmt->bind_result($id, $age_range);
     
        $selectedRows = array();
        while($stmt->fetch()){
            $row['id'] = $id;
            $row['age_range'] = $age_range;
            array_push($selectedRows, $row);
        }
        $stmt->close();

        foreach ($selectedRows as $selectedRow) {
            
            // Extract the min_age and max_age from the age_range string
            $min_age = (int) substr($selectedRow['age_range'], 0, 1);
            $max_age = (int) substr($selectedRow['age_range'], 2, 1);
     
            // Update the min_age and max_age in the games table
            $update_query = "UPDATE games SET min_age = ?, max_age = ? WHERE id = ?";
            $update_stmt = $this->conn->prepare($update_query);
            if (!$update_stmt) {
                echo "Error in preparing statement: " . $this->conn->error;
            }
            $update_stmt->bind_param("iii", $min_age, $max_age, $selectedRow['id']);
            $update_stmt->execute();
            echo $selectedRow['id']." updated<br/>";
        }
    }
    

}

?>