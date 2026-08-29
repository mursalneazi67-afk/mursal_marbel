<?php
/**
 * Security Helpers
 * Provides output escaping, CSRF protection, and input sanitization
 */

// Escape HTML special characters to prevent Cross-Site Scripting (XSS)
function e($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

// Generate or retrieve session CSRF token
function csrf_token() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Generate hidden CSRF input field for HTML forms
function csrf_field() {
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

// Verify CSRF token submitted via POST
function verify_csrf() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $postedToken = $_POST['csrf_token'] ?? '';
        $sessionToken = $_SESSION['csrf_token'] ?? '';
        if (empty($postedToken) || empty($sessionToken) || !hash_equals($sessionToken, $postedToken)) {
            http_response_code(403);
            die("CSRF Token Validation Failed. Request rejected for security.");
        }
    }
}
