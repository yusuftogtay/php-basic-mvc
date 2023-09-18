<?php

namespace App\Models;

use PDO;
use PDOException;

/**
 * User Model
 */
class User
{
    /** @var PDO */
    private PDO $pdo;

    /** @var string  username */
    public string $username;

    /** @var string password */
    public string $password;

    /** @var string email */
    public string $email;

    /**
     * Constructor
     *
     * @param [type] $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Create User
     *
     * @param string $username
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function createUser(string $username, string $email, string $password): bool
    {
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $passwordHash);

        try {
            $stmt->execute();
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Get User By ID
     *
     * @param int $id
     * @return void
     */
    public function getUserById(int $id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Update User
     *
     * @param int $id
     * @param string $username
     * @param string $email
     * @return bool
     */
    public function updateUser(int $id, string $username, string $email): bool
    {
        $sql = "UPDATE users SET username = :username, email = :email WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Delete User
     *
     * @param int $id
     * @return bool
     */
    public function deleteUser(int $id): bool
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
