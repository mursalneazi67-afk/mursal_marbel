<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($pageTitle ?? SITENAME) ?></title>

    <meta name="description" content="Mursal Marble - Premium Italian Marble, Granite, Onyx, Travertine, and Engineered Quartz Slabs Supplier.">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Your Website CSS -->
    <link href="<?= URLROOT ?>/assets/css/style.css" rel="stylesheet">

</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="<?= URLROOT ?>/">
            <span class="fs-3 text-gold"><i class="bi bi-gem"></i></span>
            <div class="lh-1">
                <span class="fw-bold fs-4 tracking-wide text-light d-block">MURSAL</span>
                <small class="text-gold fs-7 tracking-widest text-uppercase">Marble & Granites</small>
            </div>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT ?>/"><i class="bi bi-house me-1"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT ?>/about"><i class="bi bi-info-circle me-1"></i> About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT ?>/products"><i class="bi bi-grid-3x3-gap me-1"></i> Stone Catalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT ?>/contact"><i class="bi bi-envelope me-1"></i> Contact Us</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if (($_SESSION['user_role'] ?? '') === 'admin'): ?>
                        <a href="<?= URLROOT ?>/admin" class="btn btn-outline-gold rounded-pill px-3 me-2">
                            <i class="bi bi-speedometer2 me-1"></i> Admin Portal
                        </a>
                    <?php endif; ?>
                    <div class="dropdown">
                        <button class="btn btn-dark text-light dropdown-toggle rounded-pill px-3 border border-secondary" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle text-gold me-1"></i> <?= htmlspecialchars($_SESSION['user_name']) ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark border-secondary">
                            <li><span class="dropdown-item-text text-muted fs-7">Role: <?= ucfirst($_SESSION['user_role']) ?></span></li>
                            <li><hr class="dropdown-divider border-secondary"></li>
                            <li><a class="dropdown-item text-danger" href="<?= URLROOT ?>/logout"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="<?= URLROOT ?>/login" class="btn btn-outline-light rounded-pill px-3">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                    </a>
                    <a href="<?= URLROOT ?>/register" class="btn btn-gold rounded-pill px-3">
                        <i class="bi bi-person-plus me-1"></i> Register
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- System Flash Messages -->
<?php if (isset($_SESSION['flash_success'])): ?>
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0 bg-success text-white" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> <?= $_SESSION['flash_success']; ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    </div>
    <?php unset($_SESSION['flash_success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['flash_error'])): ?>
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm border-0 bg-danger text-white" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $_SESSION['flash_error']; ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    </div>
    <?php unset($_SESSION['flash_error']); ?>
<?php endif; ?>
