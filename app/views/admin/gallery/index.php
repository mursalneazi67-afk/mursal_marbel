<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 font-heading fw-bold mb-1">Installation Gallery Showcase</h2>
        <p class="text-muted small mb-0">Manage premium project photos linked to specific products.</p>
    </div>
    <a href="<?= URLROOT ?>/admin/gallery/create" class="btn btn-gold rounded-pill px-4">
        <i class="bi bi-plus-circle me-1"></i> Add Gallery Item
    </a>
</div>

<div class="card border-0 rounded-4 shadow-sm p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width: 75px;">Image</th>
                    <th>Title</th>
                    <th>Linked Product</th>
                    <th>Description</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($galleryItems)): ?>
                    <?php foreach ($galleryItems as $item): ?>
                        <tr>
                            <td>
                                <?php if (!empty($item['image'])): ?>
                                    <img src="<?= URLROOT ?>/uploads/gallery/<?= htmlspecialchars($item['image']) ?>" alt="Gallery" class="rounded border" style="width: 50px; height: 50px; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1590381105924-c72589b9ef3f?auto=format&fit=crop&w=100&q=80';">
                                <?php else: ?>
                                    <img src="https://images.unsplash.com/photo-1590381105924-c72589b9ef3f?auto=format&fit=crop&w=100&q=80" alt="Gallery" class="rounded border" style="width: 50px; height: 50px; object-fit: cover;">
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold text-dark"><?= htmlspecialchars($item['title']) ?></td>
                            <td><span class="badge bg-secondary"><?= htmlspecialchars($item['product_name']) ?></span></td>
                            <td><small class="text-muted"><?= htmlspecialchars($item['description'] ?: '-') ?></small></td>
                            <td class="text-end">
                                <a href="<?= URLROOT ?>/admin/gallery/edit/<?= $item['id'] ?>" class="btn btn-sm btn-outline-dark rounded-pill me-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="<?= URLROOT ?>/admin/gallery/delete/<?= $item['id'] ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this gallery item?');">
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
                        <td colspan="5" class="text-center py-4 text-muted">No installations added to gallery.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>
