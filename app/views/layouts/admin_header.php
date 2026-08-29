<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Admin Portal - Mursal Marble') ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom Theme CSS -->
    <link href="<?= URLROOT ?>/assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Admin Top Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark-obsidian border-bottom border-secondary border-opacity-25 sticky-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center gap-2" href="<?= URLROOT ?>/admin">
            <span class="fs-4 text-gold"><i class="bi bi-shield-lock-fill"></i></span>
            <span class="fw-bold tracking-wide text-light fs-5">MURSAL ADMIN</span>
        </a>

        <div class="ms-auto d-flex align-items-center gap-3">
            <a href="<?= URLROOT ?>/" class="btn btn-sm btn-outline-gold rounded-pill px-3" target="_blank">
                <i class="bi bi-globe me-1"></i> View Live Site
            </a>
            <span class="text-light small border-start border-secondary ps-3 ms-1 d-none d-md-inline">
                Logged in as: <strong class="text-gold"><?= htmlspecialchars($_SESSION['user_name'] ?? 'Administrator') ?></strong>
            </span>
            <a href="<?= URLROOT ?>/logout" class="btn btn-sm btn-danger rounded-pill px-3 ms-2">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </div>
</nav>

<!-- System Flash Messages -->
<?php if (isset($_SESSION['flash_success'])): ?>
    <div class="container-fluid px-4 mt-3">
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> <?= $_SESSION['flash_success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    <?php unset($_SESSION['flash_success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['flash_error'])): ?>
    <div class="container-fluid px-4 mt-3">
        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm border-0" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $_SESSION['flash_error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    <?php unset($_SESSION['flash_error']); ?>
<?php endif; ?>

<!-- Admin Dashboard Main Layout Wrapper -->
<div class="container-fluid px-4 py-4">
    <div class="row g-4">
        <!-- Sidebar Navigation -->
        <div class="col-lg-2 col-md-3">
            <div class="admin-sidebar p-3 rounded-4 shadow-sm">
                <div class="text-uppercase text-muted fs-7 fw-bold px-3 mb-2">Management</div>
                <a href="<?= URLROOT ?>/admin" class="admin-nav-item <?= ($pageTitle ?? '') === 'Admin Dashboard' ? 'active' : '' ?>">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="<?= URLROOT ?>/admin/products" class="admin-nav-item <?= strpos($pageTitle ?? '', 'Product') !== false ? 'active' : '' ?>">
                    <i class="bi bi-box-seam"></i> Products Catalog
                </a>
                <a href="<?= URLROOT ?>/admin/categories" class="admin-nav-item <?= strpos($pageTitle ?? '', 'Categor') !== false ? 'active' : '' ?>">
                    <i class="bi bi-tags"></i> Categories
                </a>
                <a href="<?= URLROOT ?>/admin/gallery" class="admin-nav-item <?= strpos($pageTitle ?? '', 'Gallery') !== false ? 'active' : '' ?>">
                    <i class="bi bi-images"></i> Installation Gallery
                </a>
                <a href="<?= URLROOT ?>/admin/messages" class="admin-nav-item <?= strpos($pageTitle ?? '', 'Messages') !== false ? 'active' : '' ?>">
                    <i class="bi bi-chat-left-text"></i> Customer Inquiries
                </a>

                <div class="text-uppercase text-muted fs-7 fw-bold px-3 mt-4 mb-2">System</div>
                <a href="<?= URLROOT ?>/" class="admin-nav-item">
                    <i class="bi bi-shop"></i> Store Front
                </a>
                <a href="<?= URLROOT ?>/logout" class="admin-nav-item text-danger">
                    <i class="bi bi-box-arrow-right"></i> Sign Out
                </a>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="col-lg-10 col-md-9">
