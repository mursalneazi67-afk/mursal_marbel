<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 font-heading fw-bold mb-1">Categories Directory</h2>
        <p class="text-muted small mb-0">List of stone classifications.</p>
    </div>
    <a href="<?= URLROOT ?>/admin/categories/create" class="btn btn-gold rounded-pill px-4">
        <i class="bi bi-plus-circle me-1"></i> Add Category
    </a>
</div>

<div class="card border-0 rounded-4 shadow-sm p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Product Count</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $cat): ?>
                    <tr>
                        <td class="fw-bold text-dark"><?= htmlspecialchars($cat['name']) ?></td>
                        <td><small class="text-muted"><?= htmlspecialchars($cat['description'] ?: '-') ?></small></td>
                        <td><span class="badge bg-gold text-dark"><?= $cat['product_count'] ?> Products</span></td>
                        <td class="text-end">
                            <a href="<?= URLROOT ?>/admin/categories/edit/<?= $cat['id'] ?>" class="btn btn-sm btn-outline-dark rounded-pill me-1">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="<?= URLROOT ?>/admin/categories/delete/<?= $cat['id'] ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category? Deleting a category will also permanently delete all products associated with it.');">
                                <?= csrf_field(); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>
