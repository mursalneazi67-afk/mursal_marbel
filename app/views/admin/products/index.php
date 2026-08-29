<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 font-heading fw-bold mb-1">Products Catalog</h2>
        <p class="text-muted small mb-0">List of natural stone slabs available for showcase.</p>
    </div>
    <a href="<?= URLROOT ?>/admin/products/create" class="btn btn-gold rounded-pill px-4">
        <i class="bi bi-plus-circle me-1"></i> Add Product
    </a>
</div>

<!-- Search & Filter Controls -->
<div class="card border-0 rounded-4 shadow-sm p-3 mb-4">
    <div class="row g-3">
        <div class="col-md-6 col-lg-8">
            <form action="<?= URLROOT ?>/admin/products" method="GET" class="d-flex gap-2">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search by product name..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                </div>
                <?php if (!empty($_GET['category'])): ?>
                    <input type="hidden" name="category" value="<?= intval($_GET['category']) ?>">
                <?php endif; ?>
                <button type="submit" class="btn btn-dark px-4 rounded-pill">Search</button>
                <?php if (!empty($_GET['search']) || !empty($_GET['category'])): ?>
                    <a href="<?= URLROOT ?>/admin/products" class="btn btn-outline-secondary rounded-pill px-3" title="Clear Filters"><i class="bi bi-x-lg"></i></a>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted small text-nowrap d-none d-lg-inline">Filter By:</span>
                <select class="form-select rounded-pill" onchange="location = this.value;">
                    <option value="<?= URLROOT ?>/admin/products<?= !empty($_GET['search']) ? '?search=' . urlencode($_GET['search']) : '' ?>">All Categories</option>
                    <?php foreach ($categories as $cat): ?>
                        <?php
                        $url = URLROOT . '/admin/products?category=' . $cat['id'];
                        if (!empty($_GET['search'])) $url .= '&search=' . urlencode($_GET['search']);
                        $selected = (($_GET['category'] ?? '') == $cat['id']) ? 'selected' : '';
                        ?>
                        <option value="<?= $url ?>" <?= $selected ?>><?= htmlspecialchars($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 rounded-4 shadow-sm p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width: 75px;">Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $p): ?>
                        <tr>
                            <td>
                                <?php if (!empty($p['image'])): ?>
                                    <img src="<?= URLROOT ?>/uploads/products/<?= htmlspecialchars($p['image']) ?>" alt="Slab" class="rounded border" style="width: 50px; height: 50px; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1590381105924-c72589b9ef3f?auto=format&fit=crop&w=100&q=80';">
                                <?php else: ?>
                                    <img src="https://images.unsplash.com/photo-1590381105924-c72589b9ef3f?auto=format&fit=crop&w=100&q=80" alt="Slab" class="rounded border" style="width: 50px; height: 50px; object-fit: cover;">
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold text-dark"><?= htmlspecialchars($p['name']) ?></td>
                            <td><span class="badge bg-secondary"><?= htmlspecialchars($p['category_name']) ?></span></td>
                            <td class="fw-bold text-success">
                                <?php if ($p['price'] > 0): ?>
                                    $<?= number_format($p['price'], 2) ?>
                                <?php else: ?>
                                    Contact for Price
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                $statusClass = 'bg-success-subtle text-success';
                                if ($p['status'] === 'Limited Stock') $statusClass = 'bg-warning-subtle text-warning';
                                if ($p['status'] === 'Out of Stock') $statusClass = 'bg-danger-subtle text-danger';
                                ?>
                                <span class="badge <?= $statusClass ?>"><?= htmlspecialchars($p['status']) ?></span>
                            </td>
                            <td class="text-end">
                                <a href="<?= URLROOT ?>/products/<?= htmlspecialchars($p['slug']) ?>" class="btn btn-sm btn-outline-gold rounded-pill me-1" target="_blank">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <a href="<?= URLROOT ?>/admin/products/edit/<?= $p['id'] ?>" class="btn btn-sm btn-outline-dark rounded-pill me-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="<?= URLROOT ?>/admin/products/delete/<?= $p['id'] ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product? All linked gallery items will also be removed.');">
                                    <?= csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No products found matching the criteria.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>
