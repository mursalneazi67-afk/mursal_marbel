<?php
/**
 * Category Model
 * Manages Marble, Granite & Tile classifications
 */

class Category {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllCategories() {
        $sql = "SELECT c.*, COUNT(p.id) AS product_count 
                FROM categories c 
                LEFT JOIN products p ON c.id = p.category_id 
                GROUP BY c.id 
                ORDER BY c.name ASC";
        return $this->db->fetchAll($sql);
    }

    public function getCategoryById($id) {
        return $this->db->fetch("SELECT * FROM categories WHERE id = ?", [$id]);
    }

    public function createCategory($name, $description) {
        $sql = "INSERT INTO categories (name, description) VALUES (?, ?)";
        return $this->db->query($sql, [$name, $description]);
    }

    public function updateCategory($id, $name, $description) {
        $sql = "UPDATE categories SET name = ?, description = ? WHERE id = ?";
        return $this->db->query($sql, [$name, $description, $id]);
    }

    public function deleteCategory($id) {
        return $this->db->query("DELETE FROM categories WHERE id = ?", [$id]);
    }

    public function countCategories() {
        $res = $this->db->fetch("SELECT COUNT(*) as total FROM categories");
        return $res['total'] ?? 0;
    }
}
