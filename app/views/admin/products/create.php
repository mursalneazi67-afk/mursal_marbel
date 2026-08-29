<div class="card border-0 rounded-4 shadow-sm p-4" style="max-width: 800px;">
    <h2 class="h3 font-heading fw-bold mb-4"><i class="bi bi-plus-circle text-gold me-2"></i> Add New Product</h2>
    
    <form action="<?= URLROOT ?>/admin/products/create" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label fw-semibold">Product Name *</label>
                <input type="text" name="name" class="form-control form-control-lg" placeholder="e.g. Statuario Extra" required>
            </div>
            
            <div class="col-md-4">
                <label class="form-label fw-semibold">Category *</label>
                <select name="category_id" class="form-select form-select-lg" required>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Price ($) (Set to 0.00 for "Contact for Price")</label>
                <input type="number" step="0.01" name="price" class="form-control form-control-lg" value="0.00" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select form-select-lg">
                    <option value="In Stock">In Stock</option>
                    <option value="Limited Stock">Limited Stock</option>
                    <option value="Out of Stock">Out of Stock</option>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold">Product Image</label>
                <input type="file" name="image" id="productImageInput" class="form-control" accept="image/*">
                <div class="mb-3">

                <label class="form-label">
                Display Image
                </label>

                <input 
                type="file"
                name="display_image"
                class="form-control"
>

</div>
                <img id="productImagePreview" src="" alt="Preview" class="img-thumbnail mt-2 d-none" style="max-height: 150px;">
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold">Description *</label>
                <textarea name="description" rows="4" class="form-control" placeholder="Provide detailed characteristics of the stone..." required></textarea>
            </div>

            <div class="col-12 mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-gold btn-lg rounded-pill px-4">Create Product</button>
                <a href="<?= URLROOT ?>/admin/products" class="btn btn-outline-secondary btn-lg rounded-pill px-4">Cancel</a>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
