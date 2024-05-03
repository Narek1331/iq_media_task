<?php

require_once 'models/UrlMapping.php';

/**
 * Class URLShortenerService
 * Service class for generating and storing shortened URLs.
 */
class URLShortenerService {

    /**
     * @var UrlMapping The UrlMapping instance.
     */
    private $urlMapping;

    /**
     * URLShortenerService constructor.
     * Initializes the UrlMapping instance.
     */
    public function __construct()
    {
        $this->urlMapping = new UrlMapping();
    }

    /**
     * Generates and stores a shortened URL.
     *
     * @param string $original_url The original URL to be shortened.
     * @return UrlMapping|null The newly created UrlMapping object, or null if failed.
     */
    public function store(string $original_url){
        $generateShortUrl = $this->generateShortUrl();
        $user_id =  $_SESSION['user_id'];

        // Create a new UrlMapping instance
        $urlMapping = new UrlMapping();

        // Set properties for the UrlMapping instance
        $urlMapping->setOriginalUrl($original_url);
        $urlMapping->setShortUrl($generateShortUrl);
        $urlMapping->setUserId($user_id); 

        // Store the new UrlMapping instance
        $newMapping = $urlMapping->store();

        return $newMapping;
    }

    /**
     * Generates a random short URL.
     *
     * @return string The generated short URL.
     */
    public function generateShortUrl() {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $shortUrl = '';
        $length = strlen($characters);
        for ($i = 0; $i < 6; $i++) {
            $shortUrl .= $characters[rand(0, $length - 1)];
        }
        return $shortUrl;
    }

}
?>
