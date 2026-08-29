<?php
/**
 * Product Controller
 * Handles Public Stone Catalog, Dynamic Product Detail view, and Admin Product CRUD
 */

class ProductController {
    private $productModel;
    private $categoryModel;
    private $galleryModel;

    public function __construct() {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
        $this->galleryModel = new Gallery();
    }

    // Protect administrative actions with Auth Middleware Guard
    private function checkAdminAuth() {
        if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
            $_SESSION['flash_error'] = "Access denied. Administrative privileges required.";
            header('Location: ' . URLROOT . '/login');
            exit();
        }
    }

    // ------------------------------------------------------------------------
    // Public Catalog Actions
    // ------------------------------------------------------------------------

    // Public catalog listing with category filtering and keyword search
public function index() {

    $categoryId = isset($_GET['category']) ? intval($_GET['category']) : null;
    $search = isset($_GET['search']) ? trim($_GET['search']) : null;

    $products = $this->productModel->getAllProducts($categoryId, $search);

    $categories = $this->categoryModel->getAllCategories();

    $selectedCategory = $categoryId 
        ? $this->categoryModel->getCategoryById($categoryId) 
        : null;

    $pageTitle = "Stone Collection - Mursal Marble Catalog";


    require_once APPROOT . '/app/views/layouts/header.php';
    require_once APPROOT . '/app/views/products/index.php';
    require_once APPROOT . '/app/views/layouts/footer.php';

}

    // Public product detail page via dynamic URL slug (/products/{slug})
    public function detail($slug) {
        $product = $this->productModel->getProductBySlug($slug);

        // Fallback: If not found by slug, try by numeric ID
        if (!$product && is_numeric($slug)) {
            $product = $this->productModel->getProductById(intval($slug));
        }

        if (!$product) {
            header('Location: ' . URLROOT . '/products');
            exit();
        }

            $galleryPhotos = $this->galleryModel->getByProductId($product['id']) ?? [];
            $variants = $this->productModel->getVariants($product['id']) ?? [];
            $productImages = $this->productModel->getProductImages($product['id']);

            $relatedProducts = $this->productModel->getRelatedProducts(
            $product['category_id'], 
            $product['id'], 
            3
);
$pdfFile = '';

$pageTitle = htmlspecialchars($product['name']) . " - Spec Sheet";

        require_once APPROOT . '/app/views/layouts/header.php';
        require_once APPROOT . '/app/views/products/detail.php';
        require_once APPROOT . '/app/views/layouts/footer.php';
    }

    // Legacy query parameter detail handler (/product?id=X)
    public function detailLegacy() {
        $id = intval($_GET['id'] ?? 0);
        $product = $this->productModel->getProductById($id);
        if ($product && !empty($product['slug'])) {
            header('Location: ' . URLROOT . '/products/' . $product['slug']);
            exit();
        }
        header('Location: ' . URLROOT . '/products');
        exit();
    }

    // ------------------------------------------------------------------------
    // Protected Admin Product Actions
    // ------------------------------------------------------------------------

    // Admin products list view (/admin/products)
    public function adminIndex() {
        $this->checkAdminAuth();
        $categoryId = isset($_GET['category']) ? intval($_GET['category']) : null;
        $search = isset($_GET['search']) ? trim($_GET['search']) : null;

        $products = $this->productModel->getAllProducts($categoryId, $search);
        $categories = $this->categoryModel->getAllCategories();
        
        $pageTitle = "Manage Products";

        require_once APPROOT . '/app/views/layouts/admin_header.php';
        require_once APPROOT . '/app/views/admin/products/index.php';
        require_once APPROOT . '/app/views/layouts/footer.php';
    }

    // Admin create product form (/admin/products/create)
    public function adminCreateView() {
        $this->checkAdminAuth();
        $categories = $this->categoryModel->getAllCategories();
        $pageTitle = "Add New Product";

        require_once APPROOT . '/app/views/layouts/admin_header.php';
        require_once APPROOT . '/app/views/admin/products/create.php';
        require_once APPROOT . '/app/views/layouts/footer.php';
    }

    // Process POST create product
    public function processAdminCreate() {
        $this->checkAdminAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $category_id = intval($_POST['category_id'] ?? 0);
            $price = floatval($_POST['price'] ?? 0.00);
            $status = trim($_POST['status'] ?? 'In Stock');
            $description = trim($_POST['description'] ?? '');

            if (empty($name) || empty($category_id) || empty($description)) {
                $_SESSION['flash_error'] = "Please fill in all required fields.";
                header('Location: ' . URLROOT . '/admin/products/create');
                exit();
            }

            if (strlen($name) > 150) {
                $_SESSION['flash_error'] = "Product name cannot exceed 150 characters.";
                header('Location: ' . URLROOT . '/admin/products/create');
                exit();
            }

            if ($price < 0.00) {
                $_SESSION['flash_error'] = "Product price cannot be negative.";
                header('Location: ' . URLROOT . '/admin/products/create');
                exit();
            }

            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                $image = UploadHelper::upload($_FILES['image'], 'products', 'stone');
                if ($image === null && isset($_SESSION['flash_error'])) {
                    header('Location: ' . URLROOT . '/admin/products/create');
                    exit();
                }
            }
            $display_image = null;

            if (isset($_FILES['display_image']) && $_FILES['display_image']['error'] !== UPLOAD_ERR_NO_FILE) {

                $display_image = UploadHelper::upload($_FILES['display_image'], 'products', 'display');

                        if ($display_image === null && isset($_SESSION['flash_error'])) {
                        header('Location: ' . URLROOT . '/admin/products/create');
                        exit();
                }

            }

            $data = [ 
            'name' => $name, 
            'category_id' => $category_id, 
            'price' => $price, 
            'status' => $status, 
            'description' => $description, 
            'image' => $image,
            'display_image' => $display_image
];

            if ($this->productModel->createProduct($data)) {
                $_SESSION['flash_success'] = "Product '{$name}' created successfully!";
                header('Location: ' . URLROOT . '/admin/products');
            } else {
                $_SESSION['flash_error'] = "Failed to create product.";
                header('Location: ' . URLROOT . '/admin/products/create');
            }
            exit();
        }
    }

    // Admin edit product form (/admin/products/edit/{id})
    public function adminEditView($id) {
        $this->checkAdminAuth();
        $id = intval($id ?: ($_GET['id'] ?? 0));
        $product = $this->productModel->getProductById($id);

        if (!$product) {
            header('Location: ' . URLROOT . '/admin/products');
            exit();
        }

        $categories = $this->categoryModel->getAllCategories();
        $pageTitle = "Edit Product: " . htmlspecialchars($product['name']);

        require_once APPROOT . '/app/views/layouts/admin_header.php';
        require_once APPROOT . '/app/views/admin/products/edit.php';
        require_once APPROOT . '/app/views/layouts/footer.php';
    }

    // Process POST edit product
    public function processAdminEdit($id) {
        $this->checkAdminAuth();
        $id = intval($id ?: ($_GET['id'] ?? 0));

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $category_id = intval($_POST['category_id'] ?? 0);
            $price = floatval($_POST['price'] ?? 0.00);
            $status = trim($_POST['status'] ?? 'In Stock');
            $description = trim($_POST['description'] ?? '');

            if (empty($name) || empty($category_id) || empty($description)) {
                $_SESSION['flash_error'] = "Please fill in all required fields.";
                header('Location: ' . URLROOT . '/admin/products/edit/' . $id);
                exit();
            }

            if (strlen($name) > 150) {
                $_SESSION['flash_error'] = "Product name cannot exceed 150 characters.";
                header('Location: ' . URLROOT . '/admin/products/edit/' . $id);
                exit();
            }

            if ($price < 0.00) {
                $_SESSION['flash_error'] = "Product price cannot be negative.";
                header('Location: ' . URLROOT . '/admin/products/edit/' . $id);
                exit();
            }

            $product = $this->productModel->getProductById($id);
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                $image = UploadHelper::upload($_FILES['image'], 'products', 'stone');
                if ($image === null && isset($_SESSION['flash_error'])) {
                    header('Location: ' . URLROOT . '/admin/products/edit/' . $id);
                    exit();
                }
                // If new image uploaded successfully, delete the old one
                if ($image && $product && !empty($product['image'])) {
                    UploadHelper::delete($product['image'], 'products');
                }
            }
            $display_image = null;

            if (isset($_FILES['display_image']) && $_FILES['display_image']['error'] !== UPLOAD_ERR_NO_FILE) {

            $display_image = UploadHelper::upload($_FILES['display_image'], 'products', 'display');

            }
            $data = [ 
            'name' => $name, 
            'category_id' => $category_id, 
            'price' => $price, 
            'status' => $status, 
            'description' => $description, 
            'image' => $image,
            'display_image' => $display_image
];

            if ($this->productModel->updateProduct($id, $data)) {
                $_SESSION['flash_success'] = "Product updated successfully!";
                header('Location: ' . URLROOT . '/admin/products');
            } else {
                $_SESSION['flash_error'] = "Failed to update product.";
                header('Location: ' . URLROOT . '/admin/products/edit/' . $id);
            }
            exit();
        }
    }

    // Process POST delete product
    public function processAdminDelete($id) {
        $this->checkAdminAuth();
        $id = intval($id ?: ($_GET['id'] ?? 0));

        $product = $this->productModel->getProductById($id);
        $galleryItems = $this->galleryModel->getByProductId($id);

        if ($this->productModel->deleteProduct($id)) {
            // Delete product image file
            if ($product && !empty($product['image'])) {
                UploadHelper::delete($product['image'], 'products');
            }
            // Delete associated gallery image files
            foreach ($galleryItems as $item) {
                if (!empty($item['image'])) {
                    UploadHelper::delete($item['image'], 'gallery');
                }
            }
            $_SESSION['flash_success'] = "Product and all associated media deleted successfully.";
        } else {
            $_SESSION['flash_error'] = "Failed to delete product.";
        }
        header('Location: ' . URLROOT . '/admin/products');
        exit();
    }
}
