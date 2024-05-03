<?php

require_once 'services/AuthService.php';

/**
 * Class AuthController
 */
class AuthController {

    /**
     * @var AuthService The authentication service
     */
    private $authService;

    /**
     * AuthController constructor.
     * @param AuthService $authService The authentication service
     */
    public function __construct() {
        $this->authService = new AuthService();
    }

    /**
     * Display the login form
     */
    public function login(){
        include_once 'templates/auth/login.php';
    }

    /**
     * Display the registration form
     */
    public function register(){
        include_once 'templates/auth/register.php';
    }

    /**
     * Sign in user
     */
    public function signin() {
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Perform basic validation
            if (empty($username) || empty($password)) {
                // Handle empty fields
                echo "Please enter username and password.";
            } else {
                // Validate user credentials
                $user = $this->authService->findUserByName($username);

                if ($user && $this->authService->verifyPassword($password, $user->password)) {
                    // Start session and store user data
                    session_start();
                    $_SESSION['user_id'] = $user->id;
                    $_SESSION['username'] = $user->name; // Use 'name' instead of 'username'

                    header("Location: /profile");
                    exit;
                } else {
                    // Handle invalid credentials
                    echo "Invalid username or password.";
                }
            }
        }

        // Include the login view
        $this->login();
    }

    /**
     * Sign up user
     */
    public function signup() {
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Perform basic validation
            if (empty($username) || empty($email) || empty($password)) {
                // Handle empty fields
                echo "Please enter username, email, and password.";
            } else {
                // Check if the username or email is already registered
                $existingUser = $this->authService->findUserByNameOrEmail($username, $email);

                if ($existingUser) {
                    // Handle existing username or email
                    echo "Username or email already exists.";
                } else {
                    // Create a new user record
                    $hashedPassword = $this->authService->hashPassword($password);
                    $user = User::build()->setName($username)->setEmail($email)->setPassword($hashedPassword);
                    $user->save();

                    // Redirect to login page
                    header("Location: /login");
                    exit;
                }
            }
        }

        // Include the register view
        $this->register();
    }
}
?>
