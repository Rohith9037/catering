<!-- Footer Start -->
<div class="container-fluid bg-dark text-white footer pt-5 mt-5">
    <div class="container py-5">
        <div class="pb-4 mb-4 border-bottom border-secondary">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <a href="index.php" class="text-decoration-none">
                        <h1 class="text-primary mb-0"><i class="fa fa-dove me-2" style="font-size: 30px; color: #81C408;"></i>Chic Catering</h1>
                        <p class="text-secondary mb-0">Fresh and delightful catering for all special occasions</p>
                    </a>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <span class="text-light me-3"><i class="fa fa-phone-alt text-primary me-2"></i>+91 6841234567</span>
                    <span class="text-light"><i class="fa fa-envelope text-primary me-2"></i>contact@chiccatering.in</span>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-3">About Chic Catering</h4>
                <p class="mb-4 text-white-50">Chic Catering delivers gourmet cuisines and customized event catering menus across Kochi. From traditional sadhyas to continental feasts, we make your special day memorable.</p>
                <a href="service.php" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Our Services</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-3">Quick Links</h4>
                <div class="d-flex flex-column">
                    <a class="btn-link text-white-50 py-1" href="index.php">Home</a>
                    <a class="btn-link text-white-50 py-1" href="menu.php">Main Menu Packages</a>
                    <a class="btn-link text-white-50 py-1" href="submenu.php">Individual Dishes</a>
                    <a class="btn-link text-white-50 py-1" href="service.php">Catering Services</a>
                    <a class="btn-link text-white-50 py-1" href="contact.php">Contact Us</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-3">Customer Area</h4>
                <div class="d-flex flex-column">
                    <a class="btn-link text-white-50 py-1" href="login.php">Customer Login</a>
                    <a class="btn-link text-white-50 py-1" href="registration.php">Create Account</a>
                    <a class="btn-link text-white-50 py-1" href="order.php">Track Orders</a>
                    <a class="btn-link text-white-50 py-1" href="cart.php">Shopping Cart</a>
                    <a class="btn-link text-white-50 py-1" href="../admin/index.php" target="_blank">Admin Portal</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-3">Contact Us</h4>
                <p class="mb-2 text-white-50"><i class="fa fa-map-marker-alt me-3 text-primary"></i>Muthoot Plaza, 12th Floor, Kacheripady, Kochi, Kerala 682018</p>
                <p class="mb-2 text-white-50"><i class="fa fa-envelope me-3 text-primary"></i>contact@chiccatering.in</p>
                <p class="mb-2 text-white-50"><i class="fa fa-phone-alt me-3 text-primary"></i>+91 6841234567</p>
                <p class="mb-0 text-white-50"><i class="fa fa-clock me-3 text-primary"></i>Mon - Sun: 8:00 AM - 10:00 PM</p>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid bg-dark py-4 border-top border-secondary">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <span class="text-light">&copy; <?= date('Y') ?> Chic Catering. All Rights Reserved.</span>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <span class="text-light">Delivering Flavor & Joy to Every Celebration</span>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->

<!-- Mobile App Bottom Navigation Bar (App-like Tab Bar) -->
<nav class="mobile-app-bottom-bar d-flex d-lg-none" aria-label="Mobile Bottom App Navigation">
    <a href="index.php" class="app-tab <?= ($currentPage === 'index.php') ? 'active' : '' ?>">
        <div class="tab-icon"><i class="fa fa-home"></i></div>
        <span class="tab-label">Home</span>
    </a>
    <a href="menu.php" class="app-tab <?= ($currentPage === 'menu.php') ? 'active' : '' ?>">
        <div class="tab-icon"><i class="fa fa-utensils"></i></div>
        <span class="tab-label">Menu</span>
    </a>
    <a href="submenu.php" class="app-tab <?= (in_array($currentPage, ['submenu.php', 'items.php'])) ? 'active' : '' ?>">
        <div class="tab-icon"><i class="fa fa-th-large"></i></div>
        <span class="tab-label">Dishes</span>
    </a>
    <a href="cart.php" class="app-tab position-relative <?= ($currentPage === 'cart.php') ? 'active' : '' ?>">
        <div class="tab-icon position-relative">
            <i class="fa fa-shopping-bag"></i>
            <?php if (!empty($item_count) && $item_count > 0): ?>
                <span class="app-badge"><?= $item_count ?></span>
            <?php endif; ?>
        </div>
        <span class="tab-label">Cart</span>
    </a>
    <?php if ($isLoggedIn): ?>
        <a href="order.php" class="app-tab <?= (in_array($currentPage, ['order.php', 'delivered.php', 'cancelled.php'])) ? 'active' : '' ?>">
            <div class="tab-icon"><i class="fa fa-clipboard-list"></i></div>
            <span class="tab-label">Orders</span>
        </a>
    <?php else: ?>
        <a href="login.php" class="app-tab <?= ($currentPage === 'login.php' || $currentPage === 'registration.php') ? 'active' : '' ?>">
            <div class="tab-icon"><i class="fa fa-user"></i></div>
            <span class="tab-label">Account</span>
        </a>
    <?php endif; ?>
</nav>

<!-- Back to Top -->
<a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top" aria-label="Back to top"><i class="fa fa-arrow-up"></i></a>   

<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>
</html>
