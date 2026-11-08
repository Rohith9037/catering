<?php 
require('head.php'); 
?>

<!-- Hero Start -->
<div class="container-fluid py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-md-12 col-lg-7">
                <h4 class="mb-3 text-secondary font-weight-bold">100% Tasty & Authentic Foods</h4>
                <h1 class="mb-4 display-3 text-primary">Deliciously Delivered: Your Next Event Awaits!</h1>
                <p class="mb-4 text-dark fs-5">Experience unparalleled catering excellence with customized culinary packages crafted for weddings, corporate celebrations, and festive parties.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="menu.php" class="btn btn-primary rounded-pill py-3 px-5 text-white fs-5">Explore Main Menu</a>
                    <a href="submenu.php" class="btn btn-outline-primary rounded-pill py-3 px-5 fs-5">View Dishes</a>
                </div>
            </div>
            <div class="col-md-12 col-lg-5">
                <div id="carouselId" class="carousel slide position-relative shadow rounded" data-bs-ride="carousel">
                    <div class="carousel-inner rounded" role="listbox">
                        <div class="carousel-item active">
                            <img src="img/main menu.jpg" class="img-fluid w-100 rounded" style="height: 380px; object-fit: cover;" alt="Grand Feast">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center bg-dark bg-opacity-50 rounded">
                                <h3 class="text-white mb-2">Grand Feast Packages</h3>
                                <a href="menu.php" class="btn btn-primary px-4 py-2 text-white rounded-pill">Order Now</a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/leg.jpg" class="img-fluid w-100 rounded" style="height: 380px; object-fit: cover;" alt="Speciality Dishes">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center bg-dark bg-opacity-50 rounded">
                                <h3 class="text-white mb-2">A La Carte Specialities</h3>
                                <a href="submenu.php" class="btn btn-primary px-4 py-2 text-white rounded-pill">View Dishes</a>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev" aria-label="Previous slide">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next" aria-label="Next slide">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- Features Section Start -->
<div class="container-fluid featurs py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4 shadow-sm h-100">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-4 mx-auto" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-utensils fa-2x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Farm-Fresh Flavors</h5>
                        <p class="mb-0 text-muted">100% fresh, premium quality spices and ingredients in every single preparation.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4 shadow-sm h-100">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-4 mx-auto" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-calendar-check fa-2x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Flexible Event Booking</h5>
                        <p class="mb-0 text-muted">Select exact program dates and dining times with complete schedule flexibility.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4 shadow-sm h-100">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-4 mx-auto" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-truck fa-2x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Punctual Delivery</h5>
                        <p class="mb-0 text-muted">Hot, hygienic delivery directly to your event venue with expert setup assistance.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4 shadow-sm h-100">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-4 mx-auto" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa fa-phone-alt fa-2x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>24/7 Dedicated Support</h5>
                        <p class="mb-0 text-muted">Prompt assistance and customized consultations from our head catering coordinators.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Features Section End -->

<!-- Featured Menu Packages Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;">
            <h4 class="text-primary font-weight-bold">Popular Packages</h4>
            <h1 class="display-5">Signature Catering Menus</h1>
            <p class="text-muted">Handcrafted buffet collections designed to delight your guests with memorable taste.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <?php
            $featuredMenus = $dao->query("SELECT * FROM menu WHERE status=1 LIMIT 4");
            if (!empty($featuredMenus)):
                foreach ($featuredMenus as $menu):
            ?>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="rounded position-relative fruite-item h-100 d-flex flex-column shadow-sm bg-white">
                        <div class="fruite-img">
                            <img src="<?= BASE_URL . 'menu_images/' . htmlspecialchars($menu['mimage']) ?>" class="img-fluid w-100 rounded-top" style="height: 200px; object-fit: cover;" alt="<?= htmlspecialchars($menu['mname']) ?>">
                        </div>
                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Package</div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom d-flex flex-column flex-grow-1">
                            <h4 class="mb-2"><?= htmlspecialchars($menu['mname']) ?></h4>
                            <p class="text-muted small flex-grow-1"><?= htmlspecialchars($menu['description']) ?></p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <p class="text-dark fs-5 fw-bold mb-0">₹<?= htmlspecialchars($menu['mprice']) ?></p>
                                <a href="<?= $isLoggedIn ? 'bookingmenu.php?mid=' . $menu['mid'] : 'login.php' ?>" class="btn border border-secondary rounded-pill px-3 text-primary">
                                    <i class="fa fa-shopping-bag me-1 text-primary"></i> Order
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
                endforeach;
            endif; 
            ?>
        </div>
        <div class="text-center mt-5">
            <a href="menu.php" class="btn btn-primary rounded-pill py-3 px-5 text-white fs-5">
                View All Menu Packages <i class="fa fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>
<!-- Featured Menu Packages End -->

<!-- Category Preview Section Start -->
<div class="container-fluid py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;">
            <h4 class="text-primary font-weight-bold">Culinary Categories</h4>
            <h1 class="display-5">Browse by Cuisine Type</h1>
            <p class="text-muted">Select your favorite protein or specialty cuisine to view exquisite dishes.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <?php
            $cats = $dao->query("SELECT * FROM category WHERE status=1 LIMIT 6");
            if (!empty($cats)):
                foreach ($cats as $cat):
            ?>
                <div class="col-md-6 col-lg-4 col-xl-2">
                    <a href="items.php?id=<?= $cat['cid'] ?>" class="text-decoration-none">
                        <div class="card border-0 shadow-sm rounded text-center p-3 h-100 hover-card" style="transition: transform 0.2s;">
                            <img src="<?= BASE_URL . 'category_images/' . htmlspecialchars($cat['cimage']) ?>" class="card-img-top rounded mx-auto mb-3" style="width: 100px; height: 100px; object-fit: cover;" alt="<?= htmlspecialchars($cat['cname']) ?>">
                            <h5 class="card-title text-dark mb-0"><?= htmlspecialchars($cat['cname']) ?></h5>
                        </div>
                    </a>
                </div>
            <?php 
                endforeach;
            endif; 
            ?>
        </div>
    </div>
</div>
<!-- Category Preview Section End -->

<!-- Call to Action Banner Start -->
<div class="container-fluid py-5 bg-primary my-5">
    <div class="container py-5 text-center text-white">
        <h1 class="display-4 text-white mb-3">Planning an Event in Kochi?</h1>
        <p class="fs-4 mb-4">Let Chic Catering take care of the menu, so you can enjoy your celebration with peace of mind.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="contact.php" class="btn btn-secondary rounded-pill py-3 px-5 text-white fs-5">Contact Our Coordinators</a>
            <a href="menu.php" class="btn btn-light rounded-pill py-3 px-5 text-primary fs-5">Book Online</a>
        </div>
    </div>
</div>
<!-- Call to Action Banner End -->

<?php require('footer.php'); ?>
