<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 font-heading fw-bold mb-1">Administrative Overview</h2>
        <p class="text-muted small mb-0">Control panel for managing Mursal Marble stone inventory and customer inquiries.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= URLROOT ?>/admin/products" class="btn btn-outline-dark rounded-pill px-4">
            <i class="bi bi-box-seam me-1"></i> Manage Products
        </a>
        <a href="<?= URLROOT ?>/admin/products/create" class="btn btn-gold rounded-pill px-4">
            <i class="bi bi-plus-circle me-1"></i> Add New Product
        </a>
    </div>
</div>

<!-- 4 Stat Metric Cards -->
<div class="row g-4 mb-5">
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted small fw-semibold text-uppercase">Total Products</span>
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>
            <h3 class="display-6 font-heading fw-bold mb-0"><?= $productCount ?></h3>
            <small class="text-muted">Active products catalog</small>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted small fw-semibold text-uppercase">Total Categories</span>
                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                    <i class="bi bi-tags"></i>
                </div>
            </div>
            <h3 class="display-6 font-heading fw-bold mb-0"><?= $categoryCount ?></h3>
            <small class="text-muted">Stone classifications</small>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted small fw-semibold text-uppercase">Gallery Images</span>
                <div class="stat-icon bg-info bg-opacity-10 text-info">
                    <i class="bi bi-images"></i>
                </div>
            </div>
            <h3 class="display-6 font-heading fw-bold mb-0 text-info"><?= $galleryCount ?></h3>
            <small class="text-muted">Project installations</small>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted small fw-semibold text-uppercase">Contact Messages</span>
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="bi bi-chat-dots"></i>
                </div>
            </div>
            <h3 class="display-6 font-heading fw-bold mb-0 text-success"><?= $messageCount ?></h3>
            <small class="text-muted">Customer inquiries (<?= $unreadMessagesCount ?> unread)</small>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Products List -->
    <div class="col-lg-7">
        <div class="card border-0 rounded-4 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="h5 font-heading fw-bold mb-0"><i class="bi bi-box-seam text-gold me-2"></i> Recent Product Additions</h4>
                <a href="<?= URLROOT ?>/admin/products" class="btn btn-sm btn-outline-dark rounded-pill">Manage All</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle small mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th class="text-end" style="width: 220px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentProducts as $p): ?>
                            <tr>
                                <td class="fw-semibold"><?= htmlspecialchars($p['name']) ?></td>
                                <td><span class="badge bg-dark text-gold"><?= htmlspecialchars($p['category_name']) ?></span></td>
                                <td class="fw-bold">
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
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="<?= URLROOT ?>/products/<?= htmlspecialchars($p['slug']) ?>" class="btn btn-sm btn-outline-gold rounded-pill px-2 py-0" target="_blank" title="View Product">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                        <a href="<?= URLROOT ?>/admin/products/edit/<?= $p['id'] ?>" class="btn btn-sm btn-outline-dark rounded-pill px-2 py-0" title="Edit Product">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="<?= URLROOT ?>/admin/products/delete/<?= $p['id'] ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product? All linked gallery items will also be removed.');">
                                            <?= csrf_field(); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2 py-0" title="Delete Product">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Inquiries List -->
    <div class="col-lg-5">
        <div class="card border-0 rounded-4 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="h5 font-heading fw-bold mb-0"><i class="bi bi-envelope text-gold me-2"></i> Recent Inquiries</h4>
                <a href="<?= URLROOT ?>/admin/messages" class="btn btn-sm btn-outline-dark rounded-pill">Inbox</a>
            </div>

            <div class="list-group list-group-flush">
                <?php foreach ($recentMessages as $msg): ?>
                    <div class="list-group-item px-0 py-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h6 class="mb-0 text-dark font-heading"><?= htmlspecialchars($msg['name']) ?></h6>
                            <small class="text-muted"><?= date('M d', strtotime($msg['created_at'])) ?></small>
                        </div>
                        <div class="fw-semibold text-gold small mb-1"><?= htmlspecialchars($msg['subject']) ?></div>
                        <p class="text-muted small mb-0 text-truncate"><?= htmlspecialchars($msg['message']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
