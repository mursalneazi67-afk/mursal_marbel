<!-- Contact Hero Header -->
<section class="bg-dark-obsidian text-light py-5 border-bottom border-secondary border-opacity-25">
    <div class="container py-3 text-center">
        <span class="text-gold fw-bold text-uppercase tracking-widest">Get In Touch</span>
        <h1 class="display-4 font-heading fw-bold mt-1">Contact Our Stone Experts</h1>
        <p class="lead text-muted mx-auto" style="max-width: 650px;">
            Have a custom architectural project or need slab quotes? Reach out to our dedicated sales team.
        </p>
    </div>
</section>

<!-- Contact Main Layout -->
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="row g-5">
            <!-- Left Info Panel -->
            <div class="col-lg-5">
                <div class="p-4 p-md-5 bg-dark-card text-light rounded-4 shadow-lg h-100 border border-secondary border-opacity-25 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <span class="fs-2 text-gold"><i class="bi bi-gem"></i></span>
                            <h3 class="font-heading h4 text-light mb-0">Mursal Marble HQ</h3>
                        </div>

                        <div class="mb-4 d-flex gap-3">
                            <div class="stat-icon bg-dark border border-gold text-gold flex-shrink-0">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div>
                                <h6 class="font-heading text-gold mb-1">Showroom & Processing Yard</h6>
                                <p class="text-muted small mb-0">Marble Industrial Zone, Block B, Main Highway</p>
                            </div>
                        </div>

                        <div class="mb-4 d-flex gap-3">
                            <div class="stat-icon bg-dark border border-gold text-gold flex-shrink-0">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div>
                                <h6 class="font-heading text-gold mb-1">Sales & Quote Lines</h6>
                                <p class="text-muted small mb-0">+1 (800) 555-MURSAL<br>+1 (555) 019-8234</p>
                            </div>
                        </div>

                        <div class="mb-4 d-flex gap-3">
                            <div class="stat-icon bg-dark border border-gold text-gold flex-shrink-0">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div>
                                <h6 class="font-heading text-gold mb-1">Email Inquiries</h6>
                                <p class="text-muted small mb-0">sales@mursalmarble.com<br>info@mursalmarble.com</p>
                            </div>
                        </div>

                        <div class="mb-4 d-flex gap-3">
                            <div class="stat-icon bg-dark border border-gold text-gold flex-shrink-0">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div>
                                <h6 class="font-heading text-gold mb-1">Working Hours</h6>
                                <p class="text-muted small mb-0">Monday - Saturday: 8:00 AM - 7:00 PM<br>Sunday: Closed</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-top border-secondary border-opacity-25">
                        <small class="text-muted text-uppercase tracking-wider d-block mb-2">Connect With Us</small>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-sm btn-dark text-gold border border-secondary rounded-circle"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="btn btn-sm btn-dark text-gold border border-secondary rounded-circle"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="btn btn-sm btn-dark text-gold border border-secondary rounded-circle"><i class="bi bi-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Form Panel -->
            <div class="col-lg-7">
                <div class="p-4 p-md-5 bg-white rounded-4 shadow-sm border">
                    <h3 class="font-heading fw-bold text-dark mb-2">Send an Inquiry</h3>
                    <p class="text-muted mb-4 small">Fill out the form below to request samples, slab pricing, or technical advice.</p>

                    <form action="<?= URLROOT ?>/contact" method="POST">
                        <?= csrf_field(); ?>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-semibold">Your Full Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="John Doe" required>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold">Email Address <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="john@example.com" required>
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-semibold">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="form-control form-control-lg" placeholder="+1 (555) 000-0000">
                            </div>

                            <div class="col-md-6">
                                <label for="subject" class="form-label fw-semibold">Inquiry Subject <span class="text-danger">*</span></label>
                                <input type="text" id="subject" name="subject" class="form-control form-control-lg" placeholder="Quote Request / Sample Order" value="<?= htmlspecialchars($_GET['subject'] ?? '') ?>" required>
                            </div>

                            <div class="col-12">
                                <label for="message" class="form-label fw-semibold">Project Details & Requirements <span class="text-danger">*</span></label>
                                <textarea id="message" name="message" rows="5" class="form-control form-control-lg" placeholder="Please state square footage needed, stone preference, slab thickness, delivery location..." required></textarea>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-gold btn-lg w-100 rounded-pill py-3">
                                    <i class="bi bi-send-fill me-2"></i> Submit Inquiry Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Google Maps area -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="rounded-4 overflow-hidden border shadow-sm" style="height: 350px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115681.29592731215!2d4.829199279768668!3d52.354730843452655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c63fb5949a7755%3A0x6600fd4cb7c0af8d!2sAmsterdam!5e0!3m2!1sen!2snl!4v1699999999999!5m2!1sen!2snl" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

