<?php
class DbConnect {
    private $conn;
 
    function __construct() {        
    }
 
    /**
     * Establishing database connection
     * @return database connection handler
     */
    function connect() {
        echo 'a';
        require_once 'Config.php';
        echo 'b';
        
        $config = new Config();
        echo 'c';
        // Connecting to mysql database
        $this->conn = new mysqli($config::DB_HOST, $config::DB_USERNAME, $config::DB_PASSWORD, $config::DB_NAME);
        mysqli_set_charset($this->conn, "utf8");
        echo 'd';
        
        // Check for database connection error
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        // returing connection resource
        return $this->conn;
    }
}
 
?>
