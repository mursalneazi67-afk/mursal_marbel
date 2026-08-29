<?php
/**
 * Product Model
 * Performs database queries for natural stone products using PDO prepared statements
 */

class Product {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Fetch all products, with optional category filtering and search keywords
    public function getAllProducts($categoryId = null, $search = null) {
        $sql = "SELECT p.*, c.name AS category_name 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                WHERE 1=1";
        $params = [];

        if ($categoryId) {
            $sql .= " AND p.category_id = ?";
            $params[] = $categoryId;
        }

        if ($search) {
            $sql .= " AND (p.name LIKE ? OR p.description LIKE ?)";
            $searchTerm = "%{$search}%";
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }

        $sql .= " ORDER BY p.id DESC";
        return $this->db->fetchAll($sql, $params);
    }

    // Fetch featured products for the home page
    public function getFeaturedProducts($limit = 6) {
        $sql = "SELECT p.*, c.name AS category_name 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                ORDER BY p.id DESC LIMIT " . intval($limit);
        return $this->db->fetchAll($sql);
    }

    // Fetch single product by ID
    public function getProductById($id) {
        $sql = "SELECT p.*, c.name AS category_name 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                WHERE p.id = ?";
        return $this->db->fetch($sql, [$id]);
    }

    // Fetch single product by URL slug
    public function getProductBySlug($slug) {
        $sql = "SELECT p.*, c.name AS category_name 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                WHERE p.slug = ?";
        return $this->db->fetch($sql, [$slug]);
    }

    // Fetch related products under same category, excluding active product
    public function getRelatedProducts($categoryId, $excludeId, $limit = 3) {
        $sql = "SELECT p.*, c.name AS category_name 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                WHERE p.category_id = ? AND p.id != ? 
                ORDER BY RAND() LIMIT " . intval($limit);
        return $this->db->fetchAll($sql, [$categoryId, $excludeId]);
    }

    // Create new product record using prepared PDO parameters
    public function createProduct($data) { 

    $slug = $this->createSlug($data['name']); 

    
        $sql = "INSERT INTO products 
        (category_id, name, slug, description, price, image, display_image, status)  
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
     
    $params = [ 
        $data['category_id'], 
        $data['name'], 
        $slug, 
        $data['description'], 
        $data['price'], 
        $data['image'] ?? null,
        $data['display_image'] ?? null,
        $data['status'] ?? 'In Stock'
    ];
 
    return $this->db->query($sql, $params); 
}

// Update product record
public function updateProduct($id, $data) {

    $slug = $this->createSlug($data['name']);


    if (!empty($data['image']) && !empty($data['display_image'])) {

        $sql = "UPDATE products SET
        category_id = ?,
        name = ?,
        slug = ?,
        description = ?,
        price = ?,
        image = ?,
        display_image = ?,
        status = ?
        WHERE id = ?";


        $params = [
            $data['category_id'],
            $data['name'],
            $slug,
            $data['description'],
            $data['price'],
            $data['image'],
            $data['display_image'],
            $data['status'],
            $id
        ];

    }

    elseif (!empty($data['image'])) {


        $sql = "UPDATE products SET
        category_id = ?,
        name = ?,
        slug = ?,
        description = ?,
        price = ?,
        image = ?,
        status = ?
        WHERE id = ?";


        $params = [
            $data['category_id'],
            $data['name'],
            $slug,
            $data['description'],
            $data['price'],
            $data['image'],
            $data['status'],
            $id
        ];

    }

    elseif (!empty($data['display_image'])) {


        $sql = "UPDATE products SET
        category_id = ?,
        name = ?,
        slug = ?,
        description = ?,
        price = ?,
        display_image = ?,
        status = ?
        WHERE id = ?";


        $params = [
            $data['category_id'],
            $data['name'],
            $slug,
            $data['description'],
            $data['price'],
            $data['display_image'],
            $data['status'],
            $id
        ];

    }

    else {


        $sql = "UPDATE products SET
        category_id = ?,
        name = ?,
        slug = ?,
        description = ?,
        price = ?,
        status = ?
        WHERE id = ?";


        $params = [
            $data['category_id'],
            $data['name'],
            $slug,
            $data['description'],
            $data['price'],
            $data['status'],
            $id
        ];

    }


    return $this->db->query($sql, $params);
}

    // Delete product record (cascades to gallery items)
    public function deleteProduct($id) {
        return $this->db->query("DELETE FROM products WHERE id = ?", [$id]);
    }

    // Total product count metric
    public function countProducts() {
        $res = $this->db->fetch("SELECT COUNT(*) as total FROM products");
        return $res['total'] ?? 0;
    }

    // Generate URL-friendly slug string
    private function createSlug($string) {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
        return $slug ?: 'stone-' . time();
    }

public function getVariants($productId)
{
    $sql = "SELECT * FROM product_variants WHERE product_id = ?";
    
    return $this->db->fetchAll($sql, [$productId]);
}
public function getProductImages($product_id)
{
    $this->db->query(
        "SELECT * FROM product_images WHERE product_id = :product_id"
    );

    $this->db->bind(':product_id', $product_id);

    return $this->db->resultSet();
}
}   
