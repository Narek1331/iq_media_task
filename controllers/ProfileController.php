<?php

require_once 'models/User.php';
require_once 'models/UrlMapping.php';

/**
 * Class ProfileController
 * Controller responsible for handling requests related to the user profile.
 */
class ProfileController {
    
    /**
     * @var UrlMapping The UrlMapping instance.
     */
    private $urlMapping;

    /**
     * ProfileController constructor.
     * Initializes the UrlMapping instance.
     */
    public function __construct()
    {
        $this->urlMapping = new UrlMapping();
    }

    /**
     * Renders the user profile page.
     */
    public function index() {
        // Get the user id from the session
        $user_id = $_SESSION['user_id'];

        // Retrieve the user data by user id
        $user = User::findById($user_id);

        // Retrieve the URL shorteners associated with the user
        $urlShorteners = $this->urlMapping->getByUserId($user_id);

        // Include the profile index template
        include_once 'templates/profile/index.php';
    }
}
?>
