<?php 
require('head.php'); 

if (!$isLoggedIn) {
    echo "<script>alert('Please log in to proceed to checkout.'); window.location='login.php';</script>";
    exit;
}

$userEmail = $_SESSION['email'];
$b = "SELECT * FROM login WHERE lemail='" . addslashes($userEmail) . "'";
$info1 = $dao->query($b);
$currentUser = $info1[0] ?? array();

$q = "SELECT * FROM booking WHERE status=1 AND email='" . addslashes($userEmail) . "'";
$cartItems = $dao->query($q);

if (empty($cartItems)) {
    echo "<script>alert('Your cart is empty.'); window.location='cart.php';</script>";
    exit;
}

$total = 0;
foreach ($cartItems as $ci) {
    $total += floatval($ci['total']);
}
$_SESSION['total'] = $total;

$errorMsg = "";
if (isset($_POST['order'])) {
    if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['pincode']) && !empty($_POST['mobile'])) {
        $_SESSION['fname'] = $_POST['fname']; 	
        $_SESSION['lname'] = $_POST['lname'];	  	
        $_SESSION['address'] = $_POST['address'];
        $_SESSION['city'] = $_POST['city'];
        $_SESSION['country'] = $_POST['country'] ?? 'India';	
        $_SESSION['pincode'] = $_POST['pincode'];
        $_SESSION['mobile'] = $_POST['mobile'];
        $_SESSION['lemail'] = $userEmail;

        echo "<script>location.href='payments.php';</script>";
        exit;
    } else {
        $errorMsg = "Please fill in all required delivery address fields.";
    }
}
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Checkout</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="cart.php">Cart</a></li>
        <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h2 class="mb-4 text-dark font-weight-bold">Event & Delivery Details</h2>

        <?php if (!empty($errorMsg)): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i><?= htmlspecialchars($errorMsg) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="row g-5">
                <div class="col-md-12 col-lg-7">
                    <div class="bg-light p-4 rounded shadow-sm">
                        <h4 class="mb-4 pb-2 border-bottom">Contact & Venue Address</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fname" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" id="fname" class="form-control" name="fname" value="<?= htmlspecialchars($currentUser['fname'] ?? '') ?>" required autocomplete="given-name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lname" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" id="lname" class="form-control" name="lname" value="<?= htmlspecialchars($currentUser['lname'] ?? '') ?>" required autocomplete="family-name">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Venue / Event Address <span class="text-danger">*</span></label>
                            <input type="text" id="address" class="form-control" name="address" placeholder="Auditorium, House No, Street name, Landmark" required autocomplete="street-address">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">Town / City <span class="text-danger">*</span></label>
                                <input type="text" id="city" class="form-control" name="city" value="Kochi" required autocomplete="address-level2">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="pincode" class="form-label">Pincode <span class="text-danger">*</span></label>
                                <input type="text" id="pincode" class="form-control" name="pincode" placeholder="e.g. 682018" inputmode="numeric" required autocomplete="postal-code">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="mobile" class="form-label">Contact Mobile <span class="text-danger">*</span></label>
                                <input type="tel" id="mobile" class="form-control" value="<?= htmlspecialchars($currentUser['lphno'] ?? '') ?>" name="mobile" required autocomplete="tel">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" id="country" class="form-control" value="India" name="country" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Account Email</label>
                            <input type="email" id="email" class="form-control" value="<?= htmlspecialchars($userEmail) ?>" name="email" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-5">
                    <div class="bg-light p-4 rounded shadow-sm">
                        <h4 class="mb-4 pb-2 border-bottom">Your Order Summary</h4>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="bg-white">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col" class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $idx = 1;
                                    foreach ($cartItems as $item): 
                                    ?>
                                        <tr>
                                            <td><?= $idx ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?= htmlspecialchars($item['bimage']) ?>" class="rounded me-2" style="width: 45px; height: 35px; object-fit: cover;" alt="">
                                                    <span class="small fw-bold"><?= htmlspecialchars($item["iname"]) ?></span>
                                                </div>
                                            </td>
                                            <td class="small">₹<?= number_format(floatval($item["price"]), 2) ?></td>
                                            <td class="small"><?= htmlspecialchars($item["quantity"]) ?></td>
                                            <td class="text-end small fw-bold">₹<?= number_format(floatval($item["total"]), 2) ?></td>
                                        </tr>
                                    <?php 
                                        $idx++;
                                    endforeach; 
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr class="border-top">
                                        <th colspan="4" class="py-3">Subtotal</th>
                                        <td class="text-end py-3 fw-bold">₹<?= number_format($total, 2) ?></td>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="py-2">Catering Delivery & Setup</th>
                                        <td class="text-end py-2 text-success fw-bold">FREE</td>
                                    </tr>
                                    <tr class="border-top border-bottom">
                                        <th colspan="4" class="py-3 text-uppercase fs-5">Total Payable</th>
                                        <td class="text-end py-3 fs-5 fw-bold text-primary">₹<?= number_format($total, 2) ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="order" class="btn btn-primary rounded-pill py-3 text-white fs-5 text-uppercase fw-bold shadow">
                                Proceed to Payment <i class="fa fa-lock ms-2"></i>
                            </button>
                            <a href="cart.php" class="btn btn-outline-secondary rounded-pill py-2 text-center">
                                <i class="fa fa-arrow-left me-1"></i> Return to Cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout Page End -->

<?php require('footer.php'); ?>
