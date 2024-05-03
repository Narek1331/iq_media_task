<?php

require_once 'models/User.php';

/**
 * Class AuthService
 */
class AuthService {

    /**
     * Find a user by name
     * @param string $name User's name
     * @return User|null
     */
    public function findUserByName($name) {
        return User::findByName($name);
    }

    /**
     * Find a user by name or email
     * @param string $name User's name
     * @param string $email User's email
     * @return User|null
     */
    public function findUserByNameOrEmail($name, $email) {
        return User::findByNameOrEmail($name, $email);
    }

    /**
     * Verify user password
     * @param string $password Password to verify
     * @param string $hashedPassword Hashed password
     * @return bool
     */
    public function verifyPassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }

    /**
     * Hash password
     * @param string $password Password to hash
     * @return string
     */
    public function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
?>
