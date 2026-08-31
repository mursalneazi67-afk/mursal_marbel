<?php
/**
 * Auth Controller
 * Handles Session-based Admin & User Login and Logout
 */

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }
// the code i have used for the registration.
    public function register()
{
    require_once "../app/views/auth/register.php";
}
public function processRegister()
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check empty fields
    if(empty($name) || empty($email) || empty($password))
    {
        echo "Please fill all fields";
        return;
    }


    // Check password match
    if($password != $confirm_password)
    {
        echo "Passwords do not match";
        return;
    }
    $existingUser = $this->userModel->findUserByEmail($email);

    if($existingUser)
{
    echo "Email already registered. Please login.";
    return;
}

    // database saving code
   try {

    $result = $this->userModel->register(
        $name,
        $email,
        $password
    );


    if($result)
{
    echo "INSERT SUCCESS";
    exit();

    $_SESSION['flash_success'] = "Registration successful. Please login.";

    header("Location: " . URLROOT . "/login");
    exit();
}
else
{
    echo "Registration failed";
}

}
catch(Exception $e)
{
    echo $e->getMessage();
}
}

    // Display Login view
   public function login() {

    if (isset($_SESSION['user_id'])) {

        if (($_SESSION['user_role'] ?? '') === 'admin') {

            header('Location: ' . URLROOT . '/admin');

        } else {

            header('Location: ' . URLROOT . '/');

        }

        exit();
    }

    $pageTitle = "Login - Mursal Marble Account";

    require_once APPROOT . '/app/views/layouts/header.php';
    require_once APPROOT . '/app/views/auth/login.php';
    require_once APPROOT . '/app/views/layouts/footer.php';
}

    // Process POST Login authentication
    public function processLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) {
                $_SESSION['flash_error'] = "Please provide both email and password.";
                header('Location: ' . URLROOT . '/login');
                exit();
            }

            $user = $this->userModel->findUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                // Password match! Regenerate Session ID for security
                session_regenerate_id(true);

                // Initialize Session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role'];

                $_SESSION['flash_success'] = "Welcome back, " . htmlspecialchars($user['name']) . "!";

if ($user['role'] === 'admin') {

    header('Location: ' . URLROOT . '/admin');

} else {

    header('Location: ' . URLROOT . '/');

}

exit();
            } else {
                $_SESSION['flash_error'] = "Invalid email or password combination.";
                header('Location: ' . URLROOT . '/login');
                exit();
            }
        }
    }

    // Logout and destroy active session
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['flash_success'] = "You have been logged out successfully.";
        header('Location: ' . URLROOT . '/login');
        exit();
    }
}
