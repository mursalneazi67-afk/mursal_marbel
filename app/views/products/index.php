<!-- Catalog Header -->
<section class="bg-dark-obsidian text-light py-5 border-bottom border-secondary border-opacity-25">
    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-md-7 text-center text-md-start">
                <span class="text-gold fw-bold text-uppercase tracking-widest">Inventory Showcase</span>
                <h1 class="display-5 font-heading fw-bold mt-1">Natural Stone Catalog</h1>
                <p class="text-muted mb-0">Browse our available slabs of Marble, Granite & Tiles.</p>
            </div>
            <div class="col-md-5 mt-3 mt-md-0">
                <div class="input-group input-group-lg shadow-sm">
                    <span class="input-group-text bg-dark-card text-gold border-secondary border-opacity-25"><i class="bi bi-search"></i></span>
                    <input type="text" id="clientProductSearch" class="form-control bg-dark-card text-light border-secondary border-opacity-25" placeholder="Search by marble name or origin...">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Filter & Grid Container -->
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <!-- Stone Collection Showcase -->

<section class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">
            <span class="text-gold fw-bold text-uppercase tracking-widest">
                Explore Collections
            </span>

            <h2 class="display-6 fw-bold text-dark mt-2">
                Natural Stone Categories
            </h2>

            <p class="text-muted">
                Discover our premium Marble, Granite and Tile collections.
            </p>
        </div>


        <div class="row g-4">


            <!-- Marble -->

            <div class="col-lg-4 col-md-6">

                <a href="<?= URLROOT ?>/products?category=1" 
                   class="text-decoration-none">

                    <div class="marble-card p-4 text-center h-100">

                        <h3 class="h3 text-dark">
                            Marble Collection
                        </h3>

                        <p class="text-muted">
                            Luxury Italian and natural marble slabs.
                        </p>

                        <span class="btn btn-gold rounded-pill px-4">
                            View Marble
                        </span>

                    </div>

                </a>

            </div>



            <!-- Granite -->

            <div class="col-lg-4 col-md-6">

                <a href="<?= URLROOT ?>/products?category=2" 
                   class="text-decoration-none">

                    <div class="marble-card p-4 text-center h-100">

                        <h3 class="h3 text-dark">
                            Granite Collection
                        </h3>

                        <p class="text-muted">
                            Strong and elegant granite surfaces.
                        </p>

                        <span class="btn btn-gold rounded-pill px-4">
                            View Granite
                        </span>

                    </div>

                </a>

            </div>



            <!-- Tiles -->

            <div class="col-lg-4 col-md-6">

                <a href="<?= URLROOT ?>/products?category=3" 
                   class="text-decoration-none">

                    <div class="marble-card p-4 text-center h-100">

                        <h3 class="h3 text-dark">
                            Tile Collection
                        </h3>

                        <p class="text-muted">
                            Modern floor and wall tile designs.
                        </p>

                        <span class="btn btn-gold rounded-pill px-4">
                            View Tiles
                        </span>

                    </div>

                </a>

            </div>


        </div>

    </div>

</section>
        <!-- Category Filter Pills -->
        <div class="d-flex flex-wrap gap-2 justify-content-center mb-5">
            <a href="<?= URLROOT ?>/products" class="filter-pill <?= empty($_GET['category']) ? 'active' : '' ?>">
                <i class="bi bi-grid-fill me-1"></i> All Slabs
            </a>
            <?php foreach ($categories as $cat): ?>
                <a href="<?= URLROOT ?>/products?category=<?= $cat['id'] ?>" class="filter-pill <?= (($_GET['category'] ?? '') == $cat['id']) ? 'active' : '' ?>">
                    <?= htmlspecialchars($cat['name']) ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Product Cards Grid -->
        <div class="row g-4" id="productsGridContainer">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $prod): ?>
                    <div class="col-lg-4 col-md-6 product-card-item" data-name="<?= htmlspecialchars($prod['name']) ?>" data-category="<?= htmlspecialchars($prod['category_name']) ?>">
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
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <small class="text-gold fw-bold text-uppercase tracking-wider"><?= htmlspecialchars($prod['category_name']) ?></small>
                                    </div>
                                    <h3 class="h5 font-heading text-dark mb-2"><?= htmlspecialchars($prod['name']) ?></h3>
                                    <p class="text-muted small mb-3"><?= htmlspecialchars(substr($prod['description'], 0, 100)) ?>...</p>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                    <div>
                                        <?php if ($prod['price'] > 0): ?>
                                        <span class="price-tag">
                                        PKR <?= number_format($prod['price']) ?>
                                        </span>
                                            <?php else: ?>
                                            <span class="badge bg-light text-dark border p-2">Contact for Price</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="d-flex gap-1">
                                        <a href="<?= URLROOT ?>/products/<?= htmlspecialchars($prod['slug']) ?>" class="btn btn-sm btn-outline-gold rounded-pill px-3">
                                            Details
                                        </a>
                                        <a href="<?= URLROOT ?>/contact?subject=Inquiry for <?= urlencode($prod['name']) ?>" class="btn btn-sm btn-gold rounded-pill px-3">
                                            Contact
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <div class="p-5 bg-white rounded-4 shadow-sm border">
                        <i class="bi bi-search text-muted display-1 d-block mb-3"></i>
                        <h3 class="h4 text-dark font-heading">No products found</h3>
                        <p class="text-muted">Try selecting a different stone category.</p>
                        <a href="<?= URLROOT ?>/products" class="btn btn-gold rounded-pill px-4 mt-2">Reset Catalog</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
