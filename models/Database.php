<?php

require_once 'config/db.php'; 

/**
 * Class Database
 * Represents a database connection and provides methods for interacting with the database.
 */
class Database
{
    /**
     * @var PDO The PDO instance representing the database connection.
     */
    private $pdo;

    /**
     * Database constructor.
     * Establishes a connection to the database.
     */
    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            die();
        }
    }

    /**
     * Get the PDO instance representing the database connection.
     *
     * @return PDO The PDO instance representing the database connection.
     */
    public function getPdo()
    {
        return $this->pdo;
    }
}

?>
