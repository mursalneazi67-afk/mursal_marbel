 <!-- Hero Section -->
<section class="hero-wrapper text-center text-md-start">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="badge bg-gold-gradient text-dark px-3 py-2 rounded-pill fw-bold text-uppercase tracking-widest mb-3">
                    <i class="bi bi-star-fill me-1"></i> Quarried Stone Excellence
                </span>
                <h1 class="hero-title mb-4">
                    Premium <span class="text-gold">Marble, Granite & Tiles</span>
                </h1>
                <p class="lead text-light text-opacity-75 mb-4 pe-lg-5">
                    Importers and processors of luxury natural stone slabs, Italian marble, exotic granites, and premium tiles. Discover timeless elegance for high-end residential and commercial projects.
                </p>
                <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-md-start">
                    <a href="<?= URLROOT ?>/products" class="btn btn-gold btn-lg rounded-pill px-4">
                        <i class="bi bi-grid-3x3-gap-fill me-2"></i> Explore Products
                    </a>
                    <a href="<?= URLROOT ?>/contact" class="btn btn-outline-gold btn-lg rounded-pill px-4">
                        <i class="bi bi-chat-quote me-2"></i> Contact Us
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block mt-4 mt-lg-0">
                <div class="p-3 bg-dark-card border border-secondary border-opacity-50 rounded-4 shadow-lg">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80" alt="Mursal Marble, Granite & Tiles Premium Slab Showcase" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Mursal Marble & Granite Section Summary -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&w=800&q=80" alt="About Slabs" class="img-fluid rounded-4 shadow border">
            </div>
            <div class="col-lg-6">
                <span class="text-gold fw-bold text-uppercase tracking-widest">Heritage & Craft</span>
                <h2 class="display-6 font-heading mb-4">About Mursal Marble & Granite</h2>
                <p class="text-muted">
                    For over 25 years, Mursal Marble has extracted and supplied top-tier block slabs and custom tiles. Connecting world-class quarries directly with luxury residential and commercial architecture.
                </p>
                <p class="text-muted mb-4">
                    Our master geologists inspect and handpick blocks for density, color uniformity, and vein consistency.
                </p>
                <a href="<?= URLROOT ?>/about" class="btn btn-outline-dark rounded-pill px-4">
                    Our Story & History <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Product Categories Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="text-gold fw-bold text-uppercase tracking-widest">Collections</span>
            <h2 class="display-6 fw-bold font-heading">Product Categories</h2>
            <p class="text-muted">Discover our broad selection of materials classified for distinct applications.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <?php foreach ($categories as $cat): ?>
                <div class="col-md-4">
                    <a href="<?= URLROOT ?>/products?category=<?= $cat['id'] ?>" class="text-decoration-none">
                        <div class="marble-card h-100 p-4 border border-secondary border-opacity-10">
                            <span class="fs-1 text-gold mb-3 d-block"><i class="bi bi-layers-half"></i></span>
                            <h3 class="h4 font-heading text-dark mb-2"><?= htmlspecialchars($cat['name']) ?></h3>
                            <p class="text-muted small mb-0"><?= htmlspecialchars($cat['description']) ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <span class="text-gold fw-bold text-uppercase tracking-widest">Handpicked</span>
            <h2 class="display-6 fw-bold font-heading">Featured Products</h2>
        </div>

        <div class="row g-4">
            <?php foreach ($featuredProducts as $prod): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="marble-card h-100">
                        <div class="card-img-container">
                            <span class="badge bg-success badge-stock rounded-pill px-2 py-1 small"><?= htmlspecialchars($prod['status']) ?></span>
                            <?php if (!empty($prod['image'])): ?>
                                <img src="<?= URLROOT ?>/uploads/products/<?= htmlspecialchars($prod['image']) ?>" alt="<?= htmlspecialchars($prod['name']) ?>" onerror="this.src='https://images.unsplash.com/photo-1590381105924-c72589b9ef3f?auto=format&fit=crop&w=600&q=80';">
                            <?php else: ?>
                                <img src="https://images.unsplash.com/photo-1590381105924-c72589b9ef3f?auto=format&fit=crop&w=600&q=80" alt="Marble Slab">
                            <?php endif; ?>
                        </div>
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <small class="text-gold fw-bold text-uppercase tracking-wider"><?= htmlspecialchars($prod['category_name']) ?></small>
                                <h3 class="h5 font-heading text-dark mt-1 mb-2"><?= htmlspecialchars($prod['name']) ?></h3>
                                <p class="text-muted small mb-3"><?= htmlspecialchars(substr($prod['description'], 0, 100)) ?>...</p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <div>
                                    <?php if ($prod['price'] > 0): ?>
                                        <span class="price-tag">$<?= number_format($prod['price'], 2) ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-light text-dark border p-2">Contact for Price</span>
                                    <?php endif; ?>
                                </div>
                                <a href="<?= URLROOT ?>/products/<?= htmlspecialchars($prod['slug']) ?>" class="btn btn-sm btn-gold rounded-pill px-3">
                                    View Details <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="text-gold fw-bold text-uppercase tracking-widest">Our Promise</span>
                <h2 class="display-6 font-heading mb-4">Why Choose Mursal Marble?</h2>
                <div class="d-flex gap-3 mb-4">
                    <div class="stat-icon bg-warning bg-opacity-10 text-gold flex-shrink-0">
                        <i class="bi bi-gem"></i>
                    </div>
                    <div>
                        <h4 class="h5 font-heading">Premium Handpicked Slabs</h4>
                        <p class="text-muted small">We source our stones from top-tier quarries to ensure pristine density and shine.</p>
                    </div>
                </div>
                <div class="d-flex gap-3 mb-4">
                    <div class="stat-icon bg-warning bg-opacity-10 text-gold flex-shrink-0">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div>
                        <h4 class="h5 font-heading">Resin Line Guarantee</h4>
                        <p class="text-muted small">All slabs are protected with premium optical epoxies for durability.</p>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <div class="stat-icon bg-warning bg-opacity-10 text-gold flex-shrink-0">
                        <i class="bi bi-telephone-outbound"></i>
                    </div>
                    <div>
                        <h4 class="h5 font-heading">Elite Client Advisory</h4>
                        <p class="text-muted small">Consult with stone designers to find matching vein patterns for bookmatching.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=800&q=80" alt="Processing" class="img-fluid rounded-4 shadow border">
            </div>
        </div>
    </div>
</section>

<!-- Gallery Preview Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <span class="text-gold fw-bold text-uppercase tracking-widest">Showcase</span>
            <h2 class="display-6 fw-bold font-heading">Installation Gallery</h2>
            <p class="text-muted font-heading">Real-life installations of Mursal Marble collections.</p>
        </div>

        <div class="row g-4">
<?php foreach ($galleryItems as $gal): ?>
                    <div class="col-md-4">
                    <div class="marble-card h-100">
                        <div class="card-img-container" style="height: 300px;">
                            <?php if (!empty($gal['image'])): ?>
<img src="<?= URLROOT ?>/uploads/gallery/<?= htmlspecialchars($gal['image']) ?>" 
     alt="<?= htmlspecialchars($gal['title']) ?>">                            <?php else: ?>
<img src="<?= URLROOT ?>/uploads/gallery/default.jpg" alt="Gallery Slab">                            <?php endif; ?>
                        </div>
                        <div class="p-3 text-center bg-light">
                            <h5 class="h6 font-heading text-dark mb-1"><?= htmlspecialchars($gal['title']) ?></h5>
                            <span class="badge bg-dark text-gold small"><?= htmlspecialchars($gal['product_name'] ?? 'Product Item') ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-5 bg-dark-obsidian text-light text-center border-top border-gold border-opacity-25">
    <div class="container py-4">
        <h2 class="display-6 font-heading text-light mb-3">Begin Your Luxury Project</h2>
        <p class="lead text-muted mx-auto mb-4" style="max-width: 600px;">
            Order premium custom cut-to-size slabs today or contact our engineering advisors for assistance.
        </p>
        <a href="<?= URLROOT ?>/contact" class="btn btn-gold btn-lg rounded-pill px-5">
            <i class="bi bi-chat-quote-fill me-2"></i> Get Free Quotation
        </a>
    </div>
</section>
