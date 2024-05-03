<?php

require_once 'Database.php';

/**
 * Class User
 */
class User {
    /**
     * @var int User ID
     */
    public $id;
    /**
     * @var string User name
     */
    public $name;
    /**
     * @var string User email
     */
    public $email;
    /**
     * @var string User password
     */
    public $password;
    /**
     * @var PDO Database connection
     */
    private $pdo;

    /**
     * Constructor with database connection
     */
    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getPdo();
    }

    /**
     * Builder method to set name
     * @param string $name User's name
     * @return User
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
    /**
     * Builder method to set id
     * @param int $id User's ID
     * @return User
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Builder method to set email
     * @param string $email User's email
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * Builder method to set password
     * @param string $password User's password
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    /**
     * Static method to create a new user instance
     * @return User
     */
    public static function build() {
        return new self();
    }

    /**
     * Method to save user data to the database
     */
    public function save() {
        // Prepare SQL statement
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$this->name, $this->email, $this->password]);
    }

    /**
     * Method to find a user by name
     * @param string $name User's name
     * @return User|null
     */
    public static function findByName($name) {
        $db = new Database();
        $pdo = $db->getPdo();
        
        // Prepare SQL statement
        $stmt = $pdo->prepare("SELECT * FROM users WHERE name = ?");
        $stmt->execute([$name]);

        // Get result
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // User found, return User object
            return self::build()->setName($user['name'])
                ->setEmail($user['email'])
                ->setPassword($user['password'])
                ->setId($user['id']);
        } else {
            // User not found, return null
            return null;
        }
    }

    /**
     * Method to find a user by name or email
     * @param string $name User's name
     * @param string $email User's email
     * @return User|null
     */
    public static function findByNameOrEmail($name, $email) {
        $db = new Database();
        $pdo = $db->getPdo();
        
        // Prepare SQL statement
        $stmt = $pdo->prepare("SELECT * FROM users WHERE name = ? OR email = ?");
        $stmt->execute([$name, $email]);

        // Get result
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // User found, return User object
            return self::build()->setName($user['name'])
                ->setEmail($user['email'])
                ->setPassword($user['password'])
                ->setId($user['id']);
        } else {
            // User not found, return null
            return null;
        }
    }

    /**
     * Method to find a user by ID
     * @param int $id User's ID
     * @return User|null
     */
    public static function findById($id) {
        $db = new Database();
        $pdo = $db->getPdo();
        
        // Prepare SQL statement
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);

        // Get result
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // User found, return User object
            return self::build()->setName($user['name'])
                ->setEmail($user['email'])
                ->setPassword($user['password'])
                ->setId($user['id']);
        } else {
            // User not found, return null
            return null;
        }
    }

    // You can add other methods as needed...

    /**
     * Get the database connection
     * @return PDO Database connection
     */
    private static function getDbConnection() {
        $db = new Database();
        return $db->getPdo();
    }
}

?>
