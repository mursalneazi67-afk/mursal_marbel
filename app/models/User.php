<?php
/**
 * User Model
 * Manages Customer & Admin accounts
 */

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findUserByEmail($email) {
        return $this->db->fetch("SELECT * FROM users WHERE email = ?", [$email]);
    }

    public function getUserById($id) {
        return $this->db->fetch("SELECT id, name, email, role, created_at FROM users WHERE id = ?", [$id]);
    }

    public function register($name, $email, $password, $role = 'customer') {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        return $this->db->query($sql, [$name, $email, $hashedPassword, $role]);
    }

    public function login($email, $password) {
        $user = $this->findUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getAllUsers() {
        return $this->db->fetchAll("SELECT id, name, email, role, created_at FROM users ORDER BY id DESC");
    }

    public function countUsers() {
        $res = $this->db->fetch("SELECT COUNT(*) as total FROM users");
        return $res['total'] ?? 0;
    }
}
