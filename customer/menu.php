<?php 
require('head.php'); 
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Main Menu Packages</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active text-white">Main Menu</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;">
            <h4 class="text-primary font-weight-bold">Event Catering</h4>
            <h1 class="display-5">Select a Menu Package</h1>
            <p class="text-muted">Choose your preferred package to book dates, customize quantities, and schedule delivery.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <?php
            $q = "SELECT * FROM menu WHERE status=1";
            $info = $dao->query($q);
            if (!empty($info)):
                foreach ($info as $item):
            ?>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="rounded position-relative fruite-item h-100 d-flex flex-column shadow-sm bg-white">
                        <div class="fruite-img">
                            <img src="<?= BASE_URL . 'menu_images/' . htmlspecialchars($item['mimage']); ?>" class="img-fluid w-100 rounded-top" style="height: 220px; object-fit: cover;" alt="<?= htmlspecialchars($item['mname']) ?>">
                        </div>
                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Package</div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom d-flex flex-column flex-grow-1">
                            <h4 class="mb-2"><?= htmlspecialchars($item['mname']) ?></h4>
                            <p class="text-muted small flex-grow-1"><?= htmlspecialchars($item['description']) ?></p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <p class="text-dark fs-5 fw-bold mb-0">₹<?= htmlspecialchars($item['mprice']) ?></p>
                                <a 
                                    href="<?= $isLoggedIn ? 'bookingmenu.php?mid=' . $item['mid'] : 'login.php' ?>"
                                    class="btn border border-secondary rounded-pill px-3 text-primary">
                                    <i class="fa fa-shopping-bag me-1 text-primary"></i> <?= $isLoggedIn ? 'Book Package' : 'Login to Book' ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                endforeach;
            else:
            ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-4">No menu packages currently available. Please check back soon!</p>
                </div>
            <?php
            endif;
            ?>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->

<?php require('footer.php'); ?>
