    <!-- Breadcrumb Header -->
    <div class="bg-dark-obsidian text-light py-3 border-bottom border-secondary border-opacity-25">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="<?= URLROOT ?>/" class="text-gold text-decoration-none"><i class="bi bi-house me-1"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= URLROOT ?>/products" class="text-gold text-decoration-none">Stone Catalog</a></li>
                    <li class="breadcrumb-item active text-light" aria-current="page"><?= htmlspecialchars($product['name']) ?></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container product-detail-container py-4">

<div class="row g-5 align-items-start">


<!-- LEFT COLUMN IMAGE -->
<div class="col-lg-6">
<img
id="mainProductImage"
src="<?= URLROOT ?>/uploads/products/<?= !empty($product['display_image']) ? htmlspecialchars($product['display_image']) : htmlspecialchars($product['image']) ?>"
alt="<?= htmlspecialchars($product['name']) ?>"
class="img-fluid w-100 object-fit-cover"
style="min-height:420px; max-height:520px;">

</div>



<div class="product-gallery mt-3">

<?php foreach($galleryPhotos as $photo): ?>

<img

src="<?= URLROOT ?>/uploads/gallery/<?= htmlspecialchars($photo['image']) ?>"

onclick="changeMainImage(this.src)"

class="gallery-thumb"

>

<?php endforeach; ?>

</div>



</div>
<!-- END LEFT COLUMN -->



<!-- RIGHT COLUMN -->

<div class="col-lg-6">


<div class="ps-lg-3">


<h1 class="display-6 font-heading fw-bold text-dark mb-3">

<?= htmlspecialchars($product['name']) ?>

</h1>



<span class="badge bg-success">

<?= htmlspecialchars($product['status']) ?>

</span>


<table class="table table-bordered">

<tr>

<th>Material</th>

<td><?= htmlspecialchars($product['category_name']) ?></td>

</tr>


<tr>

<th>Origin</th>

<td><?= htmlspecialchars($product['origin']) ?></td>

</tr>


<tr>

<th>Color</th>

<td><?= htmlspecialchars($product['color']) ?></td>

</tr>


<tr>

<th>Finish</th>

<td><?= htmlspecialchars($product['finish']) ?></td>

</tr>


</table>



<a href="<?= URLROOT ?>/contact?subject=Inquiry"

class="btn btn-gold btn-lg rounded-pill">

REQUEST A QUOTE

</a>


</div>

</div>


</div>

</div>

                
                <div class="col-lg-6">
                    <div class="ps-lg-3">
                        <div class="mb-4">

    <h5 class="font-heading fw-bold mb-3">
        Installation Display
    </h5>

    <?php if (!empty($product['display_image'])): ?>

        <img 
        src="<?= URLROOT ?>/uploads/products/<?= htmlspecialchars($product['display_image']) ?>"
        alt="Installation Display"
        class="img-fluid rounded-4 shadow"
        style="height:300px; width:100%; object-fit:cover;"
        >

    <?php else: ?>

        <div class="alert alert-secondary">
            No display image available
        </div>

    <?php endif; ?>

</div>

                        </div>

                        <h1 class="display-6 font-heading fw-bold text-dark mb-3"> 
                            <?= htmlspecialchars($product['name']) ?>
                        </h1>
                        <span class="badge bg-success rounded-pill px-3 py-1">
                        <i class="bi bi-check-circle me-1"></i>
                            <?= htmlspecialchars($product['status']) ?>
                        </span>
                        <h5 class="font-heading fw-bold mb-2">
                        Description & Characteristics
                        </h5>
                        <div class="mb-4">

<h5 class="font-heading fw-bold mb-3">
    Installation Gallery
</h5>


<div class="row g-3">

<?php if(!empty($galleryPhotos)): ?>

<?php foreach($galleryPhotos as $photo): ?>

<div class="col-6">

<img 
src="<?= URLROOT ?>/uploads/gallery/<?= htmlspecialchars($photo['image']) ?>"
class="img-fluid rounded-4 shadow"
style="height:180px;width:100%;object-fit:cover;"
alt="Installation Image">

</div>

<?php endforeach; ?>


<?php else: ?>

<div class="alert alert-secondary">
No installation images available
</div>

<?php endif; ?>


</div>

</div>

    <div class="mt-3 text-center">

        <img
        id="sampleProductImage"
        src="<?= URLROOT ?>/uploads/products/<?= htmlspecialchars($product['image']) ?>"
        class="img-fluid rounded shadow"
        style="max-height:200px;"
        alt="Stone Sample">

        <p class="text-muted small mt-2">
            Stone Sample
        </p>

    </div>
                        <div class="p-3 bg-light rounded-3 border mb-4 d-flex align-items-baseline gap-2">
                            <?php if ($product['price'] > 0): ?>
                                <span class="display-6 font-heading fw-bold text-dark">Rs. <?= number_format($product['price'] * 280) ?> ?></span>
                            <?php else: ?>
                                <span class="display-6 font-heading fw-bold text-dark">Contact for Price</span>
                            <?php endif; ?>
                        </div>

                        <h5 class="font-heading fw-bold mb-2">Description & Characteristics</h5>
                        <p id="variantDescription" class="text-muted mb-4">
                        <?= nl2br(htmlspecialchars($product['description'])) ?>
                                </p>
                        <!-- Technical Specs Table -->
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered align-middle small">
                                <tbody>
                                    <tr>
                                        <th class="bg-light w-35 text-muted">Category</th>
                                        <td class="fw-semibold"><?= htmlspecialchars($product['category_name']) ?></td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light text-muted">Status</th>
                                        <td class="fw-semibold"><?= htmlspecialchars($product['status']) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-4">
    <h5 class="font-heading fw-bold mb-3">
        Available Applications
    </h5>

    <div class="d-flex gap-2 flex-wrap">

        <span class="badge bg-dark px-3 py-2">
            <i class="bi bi-grid-3x3-gap me-1"></i>
            Slabs
        </span>

        <span class="badge bg-dark px-3 py-2"><!-- Right Column: Specs & Inquiry -->
            <i class="bi bi-square me-1"></i>
            Tiles
        </span>

        <span class="badge bg-dark px-3 py-2">
            <i class="bi bi-tools me-1"></i>
            Custom Size
        </span>

    </div>
</div>
                                <!-- Available Formats -->

<div class="p-4 rounded-4 bg-dark text-white mb-4">

    <h5 class="text-gold fw-bold mb-3">
        Available Formats
    </h5>

    <div class="row g-3">

        <div class="col-6">
            <i class="bi bi-check-circle text-warning"></i>
            Full Slabs
        </div>

        <div class="col-6">
            <i class="bi bi-check-circle text-warning"></i>
            Tiles
        </div>

        <div class="col-6">
            <i class="bi bi-check-circle text-warning"></i>
            Custom Size
        </div>

        <div class="col-6">
            <i class="bi bi-check-circle text-warning"></i>
            Fabrication
        </div>

    </div>

</div>
                        <div class="d-grid gap-2 d-sm-flex">

    <!-- WhatsApp Inquiry -->
    <a 
    href="https://wa.me/923000000000?text=Hello%20Mursal%20Marble,%20I%20am%20interested%20in%20<?= urlencode($product['name']) ?>"
    target="_blank"
    class="btn btn-success btn-lg rounded-pill px-4 flex-grow-1">

        <i class="bi bi-whatsapp me-2"></i>
        WhatsApp Inquiry

    </a>
            <a href="<?= URLROOT ?>/uploads/specs/<?= $pdfFile ?>"
            class="btn btn-outline-secondary btn-lg rounded-pill">

            <i class="bi bi-file-earmark-pdf"></i>
            Download Spec Sheet

                </a>

    <!-- Website Inquiry -->
    <a 
    href="<?= URLROOT ?>/contact?subject=Inquiry for <?= urlencode($product['name']) ?>" 
    class="btn btn-gold btn-lg rounded-pill px-4">

        <i class="bi bi-chat-quote-fill me-2"></i>
        Request Quote

    </a>


    <!-- Call -->
    <a 
    href="tel:+923000000000" 
    class="btn btn-outline-dark btn-lg rounded-pill px-3">

        <i class="bi bi-telephone-fill"></i>

    </a>

</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products Section -->
    <section class="py-5 bg-light border-top border-bottom">
        <div class="container">
            <div class="mb-4">
                <span class="text-gold fw-bold text-uppercase tracking-widest">Similar Slabs</span>
                <h3 class="font-heading fw-bold text-dark">Related Materials</h3>
            </div>
            <div class="row g-4">
                <?php if (!empty($relatedProducts)): ?>
                    <?php foreach ($relatedProducts as $rel): ?>
                        <div class="col-md-4">
                            <div class="marble-card h-100">
                                <div class="card-img-container" style="height: 200px;">
                                    <?php if (!empty($rel['image'])): ?>
                                        <img src="<?= URLROOT ?>/uploads/products/<?= htmlspecialchars($rel['image']) ?>" alt="<?= htmlspecialchars($rel['name']) ?>" onerror="this.src='https://images.unsplash.com/photo-1590381105924-c72589b9ef3f?auto=format&fit=crop&w=600&q=80';">
                                    <?php else: ?>
                                        <img src="https://images.unsplash.com/photo-1590381105924-c72589b9ef3f?auto=format&fit=crop&w=600&q=80" alt="Marble Slab">
                                    <?php endif; ?>
                                </div>
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <small class="text-gold fw-bold text-uppercase tracking-wider"><?= htmlspecialchars($rel['category_name']) ?></small>
                                        <h4 class="h5 font-heading text-dark mt-1 mb-2"><?= htmlspecialchars($rel['name']) ?></h4>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-3">
                                        <div>
                                            <?php if ($rel['price'] > 0): ?>
                                                <span class="price-tag small">$<?= number_format($rel['price'], 2) ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-light text-dark border p-2">Contact for Price</span>
                                            <?php endif; ?>
                                        </div>
                                        <a href="<?= URLROOT ?>/products/<?= htmlspecialchars($rel['slug']) ?>" class="btn btn-sm btn-gold rounded-pill px-3">
                                            Details <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center text-muted py-4">
                        <p>No other products found in this category.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<script>

document.querySelectorAll('.variant-btn').forEach(button => {

    button.addEventListener('click', function(){

        let image = this.dataset.image;
        let sample = this.dataset.sample;
        let description = this.dataset.description;


        if(image){
            document.getElementById('mainProductImage').src =
            "<?= URLROOT ?>/uploads/products/" + image;
        }


        if(sample){
            document.getElementById('sampleProductImage').src =
            "<?= URLROOT ?>/uploads/products/" + sample;
        }


        if(description){
            document.getElementById('variantDescription').innerHTML =
            description;
        }


        document.querySelectorAll('.variant-btn')
        .forEach(btn=>{
            btn.classList.remove('active');
        });


        this.classList.add('active');

    });

});

</script>
<script>

document.querySelectorAll('.marble-card, .product-image-box')
.forEach(item=>{

item.style.opacity="0";
item.style.transform="translateY(30px)";

setTimeout(()=>{

item.style.transition="all .7s ease";
item.style.opacity="1";
item.style.transform="translateY(0)";

},200);

});

</script>