<?php
/**
 * Contact Model
 * Handles Customer inquiries & support messages
 */

class Contact {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function createMessage($name, $email, $phone, $subject, $message) {
        $sql = "INSERT INTO contacts (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)";
        return $this->db->query($sql, [$name, $email, $phone, $subject, $message]);
    }

    public function getAllMessages() {
        return $this->db->fetchAll("SELECT * FROM contacts ORDER BY created_at DESC");
    }

    public function getMessageById($id) {
        return $this->db->fetch("SELECT * FROM contacts WHERE id = ?", [$id]);
    }

    public function markAsRead($id) {
        return $this->db->query("UPDATE contacts SET status = 'read' WHERE id = ?", [$id]);
    }

    public function deleteMessage($id) {
        return $this->db->query("DELETE FROM contacts WHERE id = ?", [$id]);
    }

    public function countUnread() {
        $res = $this->db->fetch("SELECT COUNT(*) as total FROM contacts WHERE status = 'unread'");
        return $res['total'] ?? 0;
    }

    public function countAll() {
        $res = $this->db->fetch("SELECT COUNT(*) as total FROM contacts");
        return $res['total'] ?? 0;
    }
}
