<div class="card border-0 rounded-4 shadow-sm p-4" style="max-width: 600px;">
    <h2 class="h3 font-heading fw-bold mb-4"><i class="bi bi-pencil text-gold me-2"></i> Edit Gallery Item</h2>
    
    <form action="<?= URLROOT ?>/admin/gallery/edit/<?= $gallery['id'] ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="mb-3">
            <label class="form-label fw-semibold">Installation Title *</label>
            <input type="text" name="title" class="form-control form-control-lg" value="<?= htmlspecialchars($gallery['title']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Linked Product *</label>
            <select name="product_id" class="form-select form-select-lg" required>
                <?php foreach ($products as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= $p['id'] == $gallery['product_id'] ? 'selected' : '' ?>><?= htmlspecialchars($p['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Gallery Image (Leave blank to keep existing)</label>
            <input type="file" name="image" id="productImageInput" class="form-control" accept="image/*">
            <?php if (!empty($gallery['image'])): ?>
                <img id="productImagePreview" src="<?= URLROOT ?>/uploads/gallery/<?= htmlspecialchars($gallery['image']) ?>" alt="Preview" class="img-thumbnail mt-2" style="max-height: 150px;">
            <?php else: ?>
                <img id="productImagePreview" src="" alt="Preview" class="img-thumbnail mt-2 d-none" style="max-height: 150px;">
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Description</label>
            <textarea name="description" rows="3" class="form-control"><?= htmlspecialchars($gallery['description']) ?></textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-gold btn-lg rounded-pill px-4">Save Changes</button>
            <a href="<?= URLROOT ?>/admin/gallery" class="btn btn-outline-secondary btn-lg rounded-pill px-4">Cancel</a>
        </div>
    </form>
</div>
</div>
</div>
</div>
