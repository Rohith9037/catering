<?php 
require('head.php'); 
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-4 py-md-5">
    <h1 class="text-center text-white display-6">Shopping Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Cart Page Start -->
<div class="container-fluid py-4 py-md-5">
    <div class="container py-2 py-md-4">
<?php
if (!$isLoggedIn) {
?>
    <div class="text-center py-5">
        <div class="bg-light d-inline-flex p-4 rounded-circle mb-3 shadow-sm">
            <i class="fa fa-user-lock fa-3x text-primary"></i>
        </div>
        <h2 class="mb-3">Please Sign In to Access Your Cart</h2>
        <p class="text-muted mb-4 px-3" style="max-width: 500px; margin: 0 auto;">You need an active customer account to add items and manage event catering bookings.</p>
        <div class="d-flex justify-content-center gap-2 flex-wrap">
            <a href="login.php" class="btn btn-primary rounded-pill py-3 px-5 text-white fs-5 shadow-sm">Sign In Now</a>
            <a href="registration.php" class="btn btn-outline-primary rounded-pill py-3 px-5 fs-5">Create Account</a>
        </div>
    </div>
<?php
} else {
    $userEmail = $_SESSION['email'];
    $q = "SELECT * FROM booking WHERE status=1 AND email='" . addslashes($userEmail) . "'";
    $info = $dao->query($q);
    $total = 0;

    if (empty($info)) {
?>
        <div class="text-center py-5">
            <img src="img/shopping.png" style="width: 220px; max-width: 80%; height: auto;" alt="Empty Cart" class="mb-4">
            <h2 class="text-dark mb-2">Your Cart <span class="text-primary">Is Empty!</span></h2>
            <p class="text-muted mb-4 px-3">Looks like you haven't selected any catering menu packages or dishes yet.</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="menu.php" class="btn btn-primary rounded-pill py-3 px-4 text-white shadow-sm">
                    <i class="fa fa-utensils me-2"></i> Browse Main Menu
                </a>
                <a href="submenu.php" class="btn btn-outline-primary rounded-pill py-3 px-4">
                    <i class="fa fa-list me-2"></i> Browse Dishes
                </a>
            </div>
        </div>
<?php 
    } else { 
        // Calculate total first
        foreach ($info as $calcItem) {
            $total += floatval($calcItem['total']);
        }
?>
        <!-- ===============================================================
             Desktop Table View (Visible on tablet & desktop >= 768px)
             =============================================================== -->
        <div class="d-none d-md-block table-responsive shadow-sm rounded-4 mb-4 bg-white border">
            <table class="table align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th scope="col" class="ps-4" style="width: 60px;">#</th>
                        <th scope="col" style="width: 100px;">Item</th>
                        <th scope="col">Name & Event Details</th>
                        <th scope="col" style="width: 120px;">Price</th>
                        <th scope="col" style="width: 100px;">Quantity</th>
                        <th scope="col" style="width: 130px;">Program Date</th>
                        <th scope="col" style="width: 120px;">Total</th>
                        <th scope="col" style="width: 80px;" class="text-center pe-4">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($info as $item) {
                    ?>
                        <tr>
                            <td class="ps-4 text-muted fw-semibold"><?= $i + 1 ?></td>
                            <td>
                                <img src="<?= htmlspecialchars($item['bimage']) ?>" class="rounded-3 shadow-sm" style="width: 70px; height: 55px; object-fit: cover;" alt="<?= htmlspecialchars($item['iname']) ?>">
                            </td>
                            <td>
                                <h6 class="mb-1 text-dark fw-bold"><?= htmlspecialchars($item["iname"]) ?></h6>
                                <small class="text-muted"><i class="fa fa-clock text-primary me-1"></i><?= htmlspecialchars($item["btime"]) ?></small>
                            </td>
                            <td class="fw-semibold">₹<?= number_format(floatval($item["price"]), 2) ?></td>
                            <td>
                                <span class="badge bg-light text-dark border px-3 py-2 fs-6"><?= htmlspecialchars($item["quantity"]) ?></span>
                            </td>
                            <td>
                                <span class="text-dark"><i class="fa fa-calendar-alt text-primary me-1"></i><?= htmlspecialchars($item["pdate"]) ?></span>
                            </td>
                            <td class="fw-bold text-primary">₹<?= number_format(floatval($item["total"]), 2) ?></td>
                            <td class="text-center pe-4">
                                <a href="cancel_item.php?id=<?= $item["bid"] ?>" class="btn btn-sm btn-outline-danger rounded-circle" title="Remove Item" onclick="return confirm('Remove <?= addslashes($item['iname']) ?> from your cart?');">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    <?php 
                        $i++;
                    } 
                    ?>
                </tbody>
            </table>
        </div> 

        <!-- ===============================================================
             Mobile App-Style Card Layout (Visible on screens < 768px)
             =============================================================== -->
        <div class="d-block d-md-none mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3 px-1">
                <span class="text-muted fw-semibold">
                    <i class="fa fa-shopping-basket text-primary me-1"></i> <?= count($info) ?> <?= count($info) === 1 ? 'Item' : 'Items' ?> in Cart
                </span>
                <span class="text-primary fw-bold fs-6">Subtotal: ₹<?= number_format($total, 2) ?></span>
            </div>

            <?php
            foreach ($info as $item) {
            ?>
                <div class="mobile-cart-item p-3 mb-3 shadow-sm">
                    <div class="d-flex align-items-start gap-3">
                        <img src="<?= htmlspecialchars($item['bimage']) ?>" class="mobile-cart-thumb" alt="<?= htmlspecialchars($item['iname']) ?>">
                        <div class="flex-grow-1 min-w-0">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-1">
                                <h6 class="mb-0 text-dark fw-bold text-truncate" style="max-width: 180px;">
                                    <?= htmlspecialchars($item["iname"]) ?>
                                </h6>
                                <a href="cancel_item.php?id=<?= $item["bid"] ?>" 
                                   class="mobile-cart-remove-btn" 
                                   title="Remove Item" 
                                   onclick="return confirm('Remove <?= addslashes($item['iname']) ?> from cart?');"
                                   aria-label="Remove item">
                                    <i class="fa fa-trash-alt fa-sm"></i>
                                </a>
                            </div>

                            <!-- Badges for Event Date & Time -->
                            <div class="d-flex flex-wrap gap-1 mb-2">
                                <span class="badge bg-light text-secondary border mobile-cart-badge">
                                    <i class="fa fa-calendar-alt text-primary me-1"></i><?= htmlspecialchars($item["pdate"]) ?>
                                </span>
                                <span class="badge bg-light text-secondary border mobile-cart-badge">
                                    <i class="fa fa-clock text-primary me-1"></i><?= htmlspecialchars($item["btime"]) ?>
                                </span>
                            </div>

                            <!-- Qty & Pricing Row -->
                            <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                <div class="text-muted small">
                                    <span class="fw-semibold text-dark">₹<?= number_format(floatval($item["price"]), 2) ?></span>
                                    <span class="mx-1">×</span>
                                    <span class="badge bg-secondary-subtle text-dark border px-2 py-1"><?= htmlspecialchars($item["quantity"]) ?></span>
                                </div>
                                <div class="fw-bold text-primary fs-6">
                                    ₹<?= number_format(floatval($item["total"]), 2) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
            } 
            ?>
        </div>

        <!-- ===============================================================
             Cart Actions & Order Summary
             =============================================================== -->
        <div class="row g-4 justify-content-between align-items-start">
            <div class="col-12 col-md-6 order-2 order-md-1">
                <div class="d-flex flex-column flex-sm-row gap-2">
                    <a href="menu.php" class="btn btn-outline-primary rounded-pill py-3 px-4 text-center">
                        <i class="fa fa-plus me-1"></i> Add More Packages
                    </a>
                    <a href="submenu.php" class="btn btn-outline-secondary rounded-pill py-3 px-4 text-center">
                        <i class="fa fa-plus me-1"></i> Add Dishes
                    </a>
                </div>
                <div class="card border-0 bg-light rounded-4 p-3 mt-3 shadow-none">
                    <div class="d-flex align-items-center gap-2 text-muted small">
                        <i class="fa fa-shield-alt text-primary fa-lg"></i>
                        <span>100% Guaranteed Hygienic Food Preparation & Timely Event Setup.</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-5 order-1 order-md-2">
                <div class="bg-light rounded-4 p-4 shadow-sm border">
                    <h4 class="mb-3 pb-2 border-bottom fw-bold text-dark">Order Summary</h4>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Items Subtotal:</span>
                        <span class="fw-semibold text-dark">₹<?= number_format($total, 2) ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Catering Delivery & Setup:</span>
                        <span class="text-success fw-bold"><i class="fa fa-check-circle me-1"></i>Free</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4 border-top pt-3">
                        <span class="fs-5 fw-bold text-dark">Total Amount:</span>
                        <span class="fs-4 fw-bold text-primary">₹<?= number_format($total, 2) ?></span>
                    </div>
                    <div class="d-grid">
                        <a href="checkout.php" class="btn btn-primary rounded-pill py-3 text-white fs-5 text-uppercase fw-bold shadow">
                            Proceed to Checkout <i class="fa fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
<?php 
    } 
} 
?>
    </div>
</div>
<!-- Cart Page End -->

<?php require('footer.php'); ?>