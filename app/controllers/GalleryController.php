<?php
/**
 * Gallery Controller
 * Handles Administrative CRUD actions for real-world installation photos
 */

class GalleryController {
    private $galleryModel;
    private $productModel;

    public function __construct() {
        $this->checkAdminAuth();
        $this->galleryModel = new Gallery();
        $this->productModel = new Product();
    }

    private function checkAdminAuth() {
        if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
            $_SESSION['flash_error'] = "Access denied. Administrative privileges required.";
            header('Location: ' . URLROOT . '/login');
            exit();
        }
    }

    // List all gallery showcase items (/admin/gallery)
    public function adminIndex() {
        $galleryItems = $this->galleryModel->getAllItems();
        $pageTitle = "Manage Gallery";

        require_once APPROOT . '/app/views/layouts/admin_header.php';
        require_once APPROOT . '/app/views/admin/gallery/index.php';
        require_once APPROOT . '/app/views/layouts/footer.php';
    }

    // Render create gallery form (/admin/gallery/create)
    public function adminCreateView() {
        $products = $this->productModel->getAllProducts();
        $pageTitle = "Add Gallery Photo";

        require_once APPROOT . '/app/views/layouts/admin_header.php';
        require_once APPROOT . '/app/views/admin/gallery/create.php';
        require_once APPROOT . '/app/views/layouts/footer.php';
    }

    // Process POST create gallery photo
    public function processAdminCreate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = intval($_POST['product_id'] ?? 0);
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if (empty($title) || empty($product_id)) {
                $_SESSION['flash_error'] = "Title and linked product are required.";
                header('Location: ' . URLROOT . '/admin/gallery/create');
                exit();
            }

            if (strlen($title) > 150) {
                $_SESSION['flash_error'] = "Title cannot exceed 150 characters.";
                header('Location: ' . URLROOT . '/admin/gallery/create');
                exit();
            }

            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                $image = UploadHelper::upload($_FILES['image'], 'gallery', 'gal');
            }

            if (!$image) {
                if (!isset($_SESSION['flash_error'])) {
                    $_SESSION['flash_error'] = "Please select a valid image file to upload.";
                }
                header('Location: ' . URLROOT . '/admin/gallery/create');
                exit();
            }

            if ($this->galleryModel->addItem($product_id, $title, $image, $description)) {
                $_SESSION['flash_success'] = "Gallery photo added successfully!";
                header('Location: ' . URLROOT . '/admin/gallery');
            } else {
                $_SESSION['flash_error'] = "Failed to add gallery photo.";
                header('Location: ' . URLROOT . '/admin/gallery/create');
            }
            exit();
        }
    }

    // Render edit gallery form (/admin/gallery/edit/{id})
    public function adminEditView($id) {
        $id = intval($id ?: ($_GET['id'] ?? 0));
        $gallery = $this->galleryModel->getById($id);

        if (!$gallery) {
            header('Location: ' . URLROOT . '/admin/gallery');
            exit();
        }

        $products = $this->productModel->getAllProducts();
        $pageTitle = "Edit Gallery Item";

        require_once APPROOT . '/app/views/layouts/admin_header.php';
        require_once APPROOT . '/app/views/admin/gallery/edit.php';
        require_once APPROOT . '/app/views/layouts/footer.php';
    }

    // Process POST edit gallery photo
    public function processAdminEdit($id) {
        $id = intval($id ?: ($_GET['id'] ?? 0));

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = intval($_POST['product_id'] ?? 0);
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if (empty($title) || empty($product_id)) {
                $_SESSION['flash_error'] = "Title and linked product are required.";
                header('Location: ' . URLROOT . '/admin/gallery/edit/' . $id);
                exit();
            }

            if (strlen($title) > 150) {
                $_SESSION['flash_error'] = "Title cannot exceed 150 characters.";
                header('Location: ' . URLROOT . '/admin/gallery/edit/' . $id);
                exit();
            }

            $gallery = $this->galleryModel->getById($id);
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                $image = UploadHelper::upload($_FILES['image'], 'gallery', 'gal');
                if ($image === null && isset($_SESSION['flash_error'])) {
                    header('Location: ' . URLROOT . '/admin/gallery/edit/' . $id);
                    exit();
                }
                // Delete old image if replace succeeded
                if ($image && $gallery && !empty($gallery['image'])) {
                    UploadHelper::delete($gallery['image'], 'gallery');
                }
            }

            if ($this->galleryModel->updateItem($id, $product_id, $title, $image, $description)) {
                $_SESSION['flash_success'] = "Gallery photo updated successfully!";
                header('Location: ' . URLROOT . '/admin/gallery');
            } else {
                $_SESSION['flash_error'] = "Failed to update gallery photo.";
                header('Location: ' . URLROOT . '/admin/gallery/edit/' . $id);
            }
            exit();
        }
    }

    // Process POST delete gallery photo
    public function processAdminDelete($id) {
        $id = intval($id ?: ($_GET['id'] ?? 0));

        $item = $this->galleryModel->getById($id);

        if ($this->galleryModel->deleteItem($id)) {
            // Delete physical file
            if ($item && !empty($item['image'])) {
                UploadHelper::delete($item['image'], 'gallery');
            }
            $_SESSION['flash_success'] = "Gallery item deleted successfully.";
        } else {
            $_SESSION['flash_error'] = "Failed to delete gallery item.";
        }
        header('Location: ' . URLROOT . '/admin/gallery');
        exit();
    }
}
