<?php
/**
 * Admin Controller
 * Handles administrative dashboard overview and customer inquiry messages
 */

class AdminController {
    private $productModel;
    private $categoryModel;
    private $contactModel;
    private $userModel;
    private $galleryModel;

    public function __construct() {
        $this->checkAdminAuth();
        $this->productModel = new Product();
        $this->categoryModel = new Category();
        $this->contactModel = new Contact();
        $this->userModel = new User();
        $this->galleryModel = new Gallery();
    }

    // Middleware Auth Guard: Restrict access to logged-in admin users only
    private function checkAdminAuth() {
        if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
            $_SESSION['flash_error'] = "Access denied. Administrative privileges required.";
            header('Location: ' . URLROOT . '/login');
            exit();
        }
    }

    // Admin Dashboard Summary (/admin or /admin/dashboard)
    public function dashboard() {
        $productCount = $this->productModel->countProducts();
        $categoryCount = $this->categoryModel->countCategories();
        $unreadMessagesCount = $this->contactModel->countUnread();
        $userCount = $this->userModel->countUsers();
        $galleryCount = $this->galleryModel->countGallery();
        $messageCount = $this->contactModel->countAll();

        $recentProducts = array_slice($this->productModel->getAllProducts(), 0, 5);
        $recentMessages = array_slice($this->contactModel->getAllMessages(), 0, 5);

        $pageTitle = "Admin Dashboard";

        require_once APPROOT . '/app/views/layouts/admin_header.php';
        require_once APPROOT . '/app/views/admin/dashboard.php';
        require_once APPROOT . '/app/views/layouts/footer.php';
    }

    // Customer Messages Inbox (/admin/messages)
    public function messages() {
        $messages = $this->contactModel->getAllMessages();
        $pageTitle = "Inquiry Messages";

        require_once APPROOT . '/app/views/layouts/admin_header.php';
        require_once APPROOT . '/app/views/admin/messages.php';
        require_once APPROOT . '/app/views/layouts/footer.php';
    }

    // Mark inquiry message status as read (/admin/messages/read/{id})
    public function markMessageRead($id) {
        $id = intval($id ?: ($_GET['id'] ?? 0));
        if ($id) {
            $this->contactModel->markAsRead($id);
            $_SESSION['flash_success'] = "Message marked as read.";
        }
        header('Location: ' . URLROOT . '/admin/messages');
        exit();
    }

    // Process POST delete inquiry message (/admin/messages/delete/{id})
    public function processDeleteMessage($id) {
        $id = intval($id ?: ($_GET['id'] ?? 0));
        if ($id && $this->contactModel->deleteMessage($id)) {
            $_SESSION['flash_success'] = "Message deleted successfully.";
        } else {
            $_SESSION['flash_error'] = "Failed to delete message.";
        }
        header('Location: ' . URLROOT . '/admin/messages');
        exit();
    }
}
