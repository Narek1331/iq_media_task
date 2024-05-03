<?php

/**
 * Class HomeController
 * Controller responsible for handling requests related to the home page.
 */
class HomeController {
    
    /**
     * Renders the index page.
     */
    public function index() {
        include_once 'templates/home.php';
    }
}
?>
