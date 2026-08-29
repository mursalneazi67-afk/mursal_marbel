<section class="py-5 bg-light min-vh-100 d-flex align-items-center">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card border-0 rounded-4 shadow-lg overflow-hidden">
                    <div class="bg-dark-obsidian text-light p-4 text-center border-bottom border-gold border-opacity-50">
                        <span class="fs-1 text-gold"><i class="bi bi-shield-lock"></i></span>
                        <h2 class="h3 font-heading text-light mb-1">Welcome Back</h2>
                        <p class="text-muted small mb-0">Sign in to access your Mursal Marble account</p>
                    </div>

                    <div class="card-body p-4 p-md-5 bg-white">
                        <form action="<?= URLROOT ?>/login" method="POST">
                            <?= csrf_field(); ?>
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="name@example.com" required autofocus>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-key"></i></span>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-gold btn-lg w-100 rounded-pill mb-3">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Log In
                            </button>
                        </form>

                        <div class="p-3 bg-light rounded-3 border small text-muted mb-3">
                            <strong class="text-dark d-block mb-1"><i class="bi bi-info-circle text-gold me-1"></i> Demo Credentials:</strong>
                            <div><strong>Admin:</strong> <code>admin@mursalmarble.com</code> / <code>admin123</code></div>
                            <div><strong>Customer:</strong> <code>john@example.com</code> / <code>customer123</code></div>
                        </div>

                        <div class="text-center text-muted small">
                            Don't have an account yet? <a href="<?= URLROOT ?>/register" class="text-gold fw-bold text-decoration-none">Register here</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
