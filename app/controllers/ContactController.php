<?php
/**
 * Contact Controller
 * Handles Public Contact View & Inquiry Submissions
 */

class ContactController {
    private $contactModel;

    public function __construct() {
        $this->contactModel = new Contact();
    }

    // Display Contact page with address, hours, Google Maps, and inquiry form
    public function index() {
        $pageTitle = "Contact Us - Mursal Marble Sales & Inquiries";
        
        require_once APPROOT . '/app/views/layouts/header.php';
        require_once APPROOT . '/app/views/contact/index.php';
        require_once APPROOT . '/app/views/layouts/footer.php';
    }

    // Process POST submission from contact form
    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $subject = trim($_POST['subject'] ?? '');
            $message = trim($_POST['message'] ?? '');

            if (empty($name) || empty($email) || empty($subject) || empty($message)) {
                $_SESSION['flash_error'] = "Please complete all required form fields.";
                header('Location: ' . URLROOT . '/contact');
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['flash_error'] = "Please provide a valid email address.";
                header('Location: ' . URLROOT . '/contact');
                exit();
            }

            if (strlen($name) > 100) {
                $_SESSION['flash_error'] = "Name cannot exceed 100 characters.";
                header('Location: ' . URLROOT . '/contact');
                exit();
            }

            if (strlen($email) > 150) {
                $_SESSION['flash_error'] = "Email cannot exceed 150 characters.";
                header('Location: ' . URLROOT . '/contact');
                exit();
            }

            if (strlen($phone) > 30) {
                $_SESSION['flash_error'] = "Phone number cannot exceed 30 characters.";
                header('Location: ' . URLROOT . '/contact');
                exit();
            }

            if (strlen($subject) > 200) {
                $_SESSION['flash_error'] = "Subject cannot exceed 200 characters.";
                header('Location: ' . URLROOT . '/contact');
                exit();
            }

            if ($this->contactModel->createMessage($name, $email, $phone, $subject, $message)) {
                $_SESSION['flash_success'] = "Thank you! Your inquiry has been logged. Our sales team will get back to you shortly.";
            } else {
                $_SESSION['flash_error'] = "An error occurred while sending your message. Please try again.";
            }

            header('Location: ' . URLROOT . '/contact');
            exit();
        }
    }
}
