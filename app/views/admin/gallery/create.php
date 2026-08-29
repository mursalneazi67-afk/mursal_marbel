<div class="card border-0 rounded-4 shadow-sm p-4" style="max-width: 600px;">
    <h2 class="h3 font-heading fw-bold mb-4"><i class="bi bi-plus-circle text-gold me-2"></i> Add Gallery Item</h2>
    
    <form action="<?= URLROOT ?>/admin/gallery/create" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="mb-3">
            <label class="form-label fw-semibold">Installation Title *</label>
            <input type="text" name="title" class="form-control form-control-lg" placeholder="e.g. Master Suite Bathroom Wall" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Linked Product *</label>
            <select name="product_id" class="form-select form-select-lg" required>
                <?php foreach ($products as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?> (<?= htmlspecialchars($p['category_name']) ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Gallery Image *</label>
            <input type="file" name="image" id="productImageInput" class="form-control" accept="image/*" required>
            <img id="productImagePreview" src="" alt="Preview" class="img-thumbnail mt-2 d-none" style="max-height: 150px;">
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Description</label>
            <textarea name="description" rows="3" class="form-control" placeholder="Provide general description of this installation project..."></textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-gold btn-lg rounded-pill px-4">Add Item</button>
            <a href="<?= URLROOT ?>/admin/gallery" class="btn btn-outline-secondary btn-lg rounded-pill px-4">Cancel</a>
        </div>
    </form>
</div>
</div>
</div>
</div>
