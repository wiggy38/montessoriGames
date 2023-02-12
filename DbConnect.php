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
        require_once 'Config.php';
        
        $config = new Config();
        // Connecting to mysql database
        $this->conn = new mysqli($config::DB_HOST, $config::DB_USERNAME, $config::DB_PASSWORD, $config::DB_NAME);
        mysqli_set_charset($this->conn, "latin1");
        
        // Check for database connection error
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        // returing connection resource
        return $this->conn;
    }
}
 
?>
