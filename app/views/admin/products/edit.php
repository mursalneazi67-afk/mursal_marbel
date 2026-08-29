<div class="card border-0 rounded-4 shadow-sm p-4" style="max-width: 800px;">
    <h2 class="h3 font-heading fw-bold mb-4"><i class="bi bi-pencil text-gold me-2"></i> Edit Product: <?= htmlspecialchars($product['name']) ?></h2>
    
    <form action="<?= URLROOT ?>/admin/products/edit/<?= $product['id'] ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label fw-semibold">Product Name *</label>
                <input type="text" name="name" class="form-control form-control-lg" value="<?= htmlspecialchars($product['name']) ?>" required>
            </div>
            
            <div class="col-md-4">
                <label class="form-label fw-semibold">Category *</label>
                <select name="category_id" class="form-select form-select-lg" required>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $product['category_id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Price ($) (Set to 0.00 for "Contact for Price")</label>
                <input type="number" step="0.01" name="price" class="form-control form-control-lg" value="<?= htmlspecialchars($product['price']) ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select form-select-lg">
                    <option value="In Stock" <?= $product['status'] === 'In Stock' ? 'selected' : '' ?>>In Stock</option>
                    <option value="Limited Stock" <?= $product['status'] === 'Limited Stock' ? 'selected' : '' ?>>Limited Stock</option>
                    <option value="Out of Stock" <?= $product['status'] === 'Out of Stock' ? 'selected' : '' ?>>Out of Stock</option>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold">Product Image (Leave blank to keep existing)</label>
                <input type="file" name="image" id="productImageInput" class="form-control" accept="image/*">
                <?php if (!empty($product['image'])): ?>
                    <img id="productImagePreview" src="<?= URLROOT ?>/uploads/products/<?= htmlspecialchars($product['image']) ?>" alt="Preview" class="img-thumbnail mt-2" style="max-height: 150px;">
                <?php else: ?>
                    <img id="productImagePreview" src="" alt="Preview" class="img-thumbnail mt-2 d-none" style="max-height: 150px;">
                <?php endif; ?>
            </div>
            <div class="mb-3">

            <label class="form-label fw-semibold">
            Display Image
            </label>

            <input 
            type="file"
            name="display_image"
            class="form-control"
            accept="image/*"
            >

        </div>

            <div class="col-12">
                <label class="form-label fw-semibold">Description *</label>
                <textarea name="description" rows="4" class="form-control" required><?= htmlspecialchars($product['description']) ?></textarea>
            </div>

            <div class="col-12 mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-gold btn-lg rounded-pill px-4">Save Changes</button>
                <a href="<?= URLROOT ?>/admin/products" class="btn btn-outline-secondary btn-lg rounded-pill px-4">Cancel</a>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
