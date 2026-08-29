<?php
/**
 * Home Controller
 */

class HomeController {
    private $productModel;
    private $categoryModel;
    private $galleryModel;

    public function __construct() {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
        $this->galleryModel = new Gallery();
    }

    public function index() {
        $featuredProducts = $this->productModel->getFeaturedProducts(6);
        $categories = $this->categoryModel->getAllCategories();
        $galleryItems = $this->galleryModel->getAllItems();

        $pageTitle = "Mursal Marble - Natural Stone, Marble & Granite";

        require_once APPROOT . '/app/views/layouts/header.php';
        require_once APPROOT . '/app/views/home/index.php';
        require_once APPROOT . '/app/views/layouts/footer.php';
    }
}
