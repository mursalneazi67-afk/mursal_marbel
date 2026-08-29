<?php
/**
 * Category Controller
 * Handles Administrative CRUD actions for stone product categories
 */

class CategoryController {
    private $categoryModel;

    public function __construct() {
        $this->checkAdminAuth();
        $this->categoryModel = new Category();
    }

    private function checkAdminAuth() {
        if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
            $_SESSION['flash_error'] = "Access denied. Administrative privileges required.";
            header('Location: ' . URLROOT . '/login');
            exit();
        }
    }

    // List all categories (/admin/categories)
    public function adminIndex() {
        $categories = $this->categoryModel->getAllCategories();
        $pageTitle = "Manage Categories";

        require_once APPROOT . '/app/views/layouts/admin_header.php';
        require_once APPROOT . '/app/views/admin/categories/index.php';
        require_once APPROOT . '/app/views/layouts/footer.php';
    }

    // Render create category view (/admin/categories/create)
    public function adminCreateView() {
        $pageTitle = "Create Category";

        require_once APPROOT . '/app/views/layouts/admin_header.php';
        require_once APPROOT . '/app/views/admin/categories/create.php';
        require_once APPROOT . '/app/views/layouts/footer.php';
    }

    // Process POST create category
    public function processAdminCreate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if (empty($name)) {
                $_SESSION['flash_error'] = "Category name is required.";
                header('Location: ' . URLROOT . '/admin/categories/create');
                exit();
            }

            if (strlen($name) > 100) {
                $_SESSION['flash_error'] = "Category name cannot exceed 100 characters.";
                header('Location: ' . URLROOT . '/admin/categories/create');
                exit();
            }

            if ($this->categoryModel->createCategory($name, $description)) {
                $_SESSION['flash_success'] = "Category '{$name}' created successfully!";
                header('Location: ' . URLROOT . '/admin/categories');
            } else {
                $_SESSION['flash_error'] = "Failed to create category.";
                header('Location: ' . URLROOT . '/admin/categories/create');
            }
            exit();
        }
    }

    // Render edit category view (/admin/categories/edit/{id})
    public function adminEditView($id) {
        $id = intval($id ?: ($_GET['id'] ?? 0));
        $category = $this->categoryModel->getCategoryById($id);

        if (!$category) {
            header('Location: ' . URLROOT . '/admin/categories');
            exit();
        }

        $pageTitle = "Edit Category: " . htmlspecialchars($category['name']);

        require_once APPROOT . '/app/views/layouts/admin_header.php';
        require_once APPROOT . '/app/views/admin/categories/edit.php';
        require_once APPROOT . '/app/views/layouts/footer.php';
    }

    // Process POST edit category
    public function processAdminEdit($id) {
        $id = intval($id ?: ($_GET['id'] ?? 0));

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if (empty($name)) {
                $_SESSION['flash_error'] = "Category name is required.";
                header('Location: ' . URLROOT . '/admin/categories/edit/' . $id);
                exit();
            }

            if (strlen($name) > 100) {
                $_SESSION['flash_error'] = "Category name cannot exceed 100 characters.";
                header('Location: ' . URLROOT . '/admin/categories/edit/' . $id);
                exit();
            }

            if ($this->categoryModel->updateCategory($id, $name, $description)) {
                $_SESSION['flash_success'] = "Category updated successfully!";
                header('Location: ' . URLROOT . '/admin/categories');
            } else {
                $_SESSION['flash_error'] = "Failed to update category.";
                header('Location: ' . URLROOT . '/admin/categories/edit/' . $id);
            }
            exit();
        }
    }

    // Process POST delete category
    public function processAdminDelete($id) {
        $id = intval($id ?: ($_GET['id'] ?? 0));

        if ($this->categoryModel->deleteCategory($id)) {
            $_SESSION['flash_success'] = "Category deleted successfully.";
        } else {
            $_SESSION['flash_error'] = "Failed to delete category.";
        }
        header('Location: ' . URLROOT . '/admin/categories');
        exit();
    }
}
