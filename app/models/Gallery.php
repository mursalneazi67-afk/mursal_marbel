<?php
/**
 * Gallery Model
 * Manages premium showcase photos linked to products
 */

class Gallery {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllItems() {
        $sql = "SELECT g.*, p.name AS product_name 
                FROM gallery g 
                JOIN products p ON g.product_id = p.id 
                ORDER BY g.id DESC";
        return $this->db->fetchAll($sql);
    }

    public function getById($id) {
        return $this->db->fetch("SELECT * FROM gallery WHERE id = ?", [$id]);
    }

    public function getByProductId($productId) {
        return $this->db->fetchAll("SELECT * FROM gallery WHERE product_id = ?", [$productId]);
    }

    public function addItem($productId, $title, $image, $description) {
        $sql = "INSERT INTO gallery (product_id, title, image, description) VALUES (?, ?, ?, ?)";
        return $this->db->query($sql, [$productId, $title, $image, $description]);
    }

    public function updateItem($id, $productId, $title, $image, $description) {
        if ($image) {
            $sql = "UPDATE gallery SET product_id = ?, title = ?, image = ?, description = ? WHERE id = ?";
            return $this->db->query($sql, [$productId, $title, $image, $description, $id]);
        } else {
            $sql = "UPDATE gallery SET product_id = ?, title = ?, description = ? WHERE id = ?";
            return $this->db->query($sql, [$productId, $title, $description, $id]);
        }
    }

    public function deleteItem($id) {
        return $this->db->query("DELETE FROM gallery WHERE id = ?", [$id]);
    }

    public function countGallery() {
        $res = $this->db->fetch("SELECT COUNT(*) as total FROM gallery");
        return $res['total'] ?? 0;
    }
}
