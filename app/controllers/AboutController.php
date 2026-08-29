<?php
/**
 * About Controller
 */

class AboutController {
    public function index() {
        $pageTitle = "About Us - Mursal Marble Craftsmanship & Quarries";
        
        require_once APPROOT . '/app/views/layouts/header.php';
        require_once APPROOT . '/app/views/about/index.php';
        require_once APPROOT . '/app/views/layouts/footer.php';
    }
}
