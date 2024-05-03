<?php
require_once 'Database.php';

/**
 * Class UrlMapping
 * Represents URL mapping entity in the database.
 */
class UrlMapping
{
    private $pdo;

    /**
     * UrlMapping constructor.
     * Initializes a new instance of the UrlMapping class.
     */
    public function __construct()
    {
        $this->db = new Database(); // Create a new database connection
        $this->pdo = $this->db->getPdo();
    }

    // Setter methods using builder pattern

    /**
     * Set the ID of the URL mapping.
     * @param int $id The ID of the URL mapping.
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set the original URL of the URL mapping.
     * @param string $originalUrl The original URL of the URL mapping.
     * @return $this
     */
    public function setOriginalUrl($originalUrl)
    {
        $this->originalUrl = $originalUrl;
        return $this;
    }

    /**
     * Set the short URL of the URL mapping.
     * @param string $shortUrl The short URL of the URL mapping.
     * @return $this
     */
    public function setShortUrl($shortUrl)
    {
        $this->shortUrl = $shortUrl;
        return $this;
    }

    /**
     * Set the user ID associated with the URL mapping.
     * @param int $userId The user ID associated with the URL mapping.
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * Store the URL mapping data in the database.
     * @return mixed|false The ID of the inserted record if successful, otherwise false.
     */
    public function store()
    {
        try {
            $stmt = $this->pdo->prepare('INSERT INTO url_mapping (original_url, short_url, user_id) VALUES (?, ?, ?)');
            $stmt->execute([$this->originalUrl, $this->shortUrl, $this->userId]);
            $lastInsertId = $this->pdo->lastInsertId();
            return $lastInsertId ? $this->getById($lastInsertId) : false;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Get a URL mapping by its original URL.
     * @param string $originalUrl The original URL to search for.
     * @return UrlMapping|null The URL mapping if found, otherwise null.
     */
    public static function get($originalUrl)
    {
        $db = new Database(); // Create a new database connection
        $pdo = $db->getPdo();
        try {
            $stmt = $pdo->prepare('SELECT * FROM url_mapping WHERE original_url = ?');
            $stmt->execute([$originalUrl]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return (new self())
                    ->setId($result['id'])
                    ->setOriginalUrl($result['original_url'])
                    ->setShortUrl($result['short_url'])
                    ->setUserId($result['user_id']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }

    /**
     * Get a URL mapping by its ID.
     * @param int $id The ID of the URL mapping to retrieve.
     * @return UrlMapping|null The URL mapping if found, otherwise null.
     */
    public static function getById($id)
    {
        $db = new Database(); // Create a new database connection
        $pdo = $db->getPdo();
        try {
            $stmt = $pdo->prepare('SELECT * FROM url_mapping WHERE id = ?');
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return (new self())
                    ->setId($result['id'])
                    ->setOriginalUrl($result['original_url'])
                    ->setShortUrl($result['short_url'])
                    ->setUserId($result['user_id']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }

    /**
     * Get a URL mapping by its short URL.
     * @param string $shortUrl The short URL to search for.
     * @return UrlMapping|null The URL mapping if found, otherwise null.
     */
    public static function getByShortUrl($shortUrl)
    {
        $db = new Database(); // Create a new database connection
        $pdo = $db->getPdo();
        try {
            $stmt = $pdo->prepare('SELECT * FROM url_mapping WHERE short_url = ?');
            $stmt->execute([$shortUrl]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return (new self())
                    ->setId($result['id'])
                    ->setOriginalUrl($result['original_url'])
                    ->setShortUrl($result['short_url'])
                    ->setUserId($result['user_id']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }
    
    /**
     * Get URL mappings by user id.
     * @param string $user_id The user id to search for.
     * @return array|null Array of URL mappings if found, otherwise null.
     */
    public static function getByUserId($user_id)
    {
        $db = new Database(); // Create a new database connection
        $pdo = $db->getPdo();
        try {
            $stmt = $pdo->prepare('SELECT * FROM url_mapping WHERE user_id = ?');
            $stmt->execute([$user_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $urlMappings = [];
            foreach ($results as $result) {
                $urlMapping = (new self())
                    ->setId($result['id'])
                    ->setOriginalUrl($result['original_url'])
                    ->setShortUrl($result['short_url'])
                    ->setUserId($result['user_id']);
                $urlMappings[] = $urlMapping;
            }

            return $urlMappings;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }

}
?>
