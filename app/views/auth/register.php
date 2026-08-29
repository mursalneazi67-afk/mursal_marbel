<section class="py-5 bg-light min-vh-100 d-flex align-items-center">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card border-0 rounded-4 shadow-lg overflow-hidden">
                    <div class="bg-dark-obsidian text-light p-4 text-center border-bottom border-gold border-opacity-50">
                        <span class="fs-1 text-gold"><i class="bi bi-person-plus-fill"></i></span>
                        <h2 class="h3 font-heading text-light mb-1">Create Account</h2>
                        <p class="text-muted small mb-0">Join Mursal Marble for exclusive client quotes</p>
                    </div>

                    <div class="card-body p-4 p-md-5 bg-white">
                        <form action="<?= URLROOT ?>/register" method="POST">
                            <?= csrf_field(); ?>
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-person"></i></span>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="John Doe" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="name@example.com" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-key"></i></span>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="confirm_password" class="form-label fw-semibold">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-shield-check"></i></span>
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="••••••••" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-gold btn-lg w-100 rounded-pill mb-3">
                                <i class="bi bi-check-circle-fill me-2"></i> Register Account
                            </button>
                        </form>

                        <div class="text-center text-muted small">
                            Already registered? <a href="<?= URLROOT ?>/login" class="text-gold fw-bold text-decoration-none">Log in here</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- the registration desgin  -->
 <?php include __DIR__ . '/../layouts/header.php'; ?>


<div class="container mt-5">

<h1>Create Account</h1>

<form method="POST" action="<?= URLROOT ?>/register">

    <div class="mb-3">
        <label>Full Name</label>
        <input class="form-control" type="text" name="name">
    </div>

    <div class="mb-3">
        <label>Email Address</label>
        <input class="form-control" type="email" name="email">
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input class="form-control" type="password" name="password">
    </div>

    <div class="mb-3">
        <label>Confirm Password</label>
        <input class="form-control" type="password" name="confirm_password">
    </div>

    <button class="btn btn-warning">
        Register Account
    </button>

</form>

</div>


<?php include __DIR__ . '/../layouts/footer.php'; ?>