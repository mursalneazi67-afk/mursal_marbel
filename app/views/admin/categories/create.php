<div class="card border-0 rounded-4 shadow-sm p-4" style="max-width: 600px;">
    <h2 class="h3 font-heading fw-bold mb-4"><i class="bi bi-plus-circle text-gold me-2"></i> Add New Category</h2>
    
    <form action="<?= URLROOT ?>/admin/categories/create" method="POST">
        <?= csrf_field(); ?>
        <div class="mb-3">
            <label class="form-label fw-semibold">Category Name *</label>
            <input type="text" name="name" class="form-control form-control-lg" placeholder="e.g. Marble, Granite" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Description</label>
            <textarea name="description" rows="4" class="form-control" placeholder="Provide general qualities of this stone category..."></textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-gold btn-lg rounded-pill px-4">Create Category</button>
            <a href="<?= URLROOT ?>/admin/categories" class="btn btn-outline-secondary btn-lg rounded-pill px-4">Cancel</a>
        </div>
    </form>
</div>
</div>
</div>
</div>
