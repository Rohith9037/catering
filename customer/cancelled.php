<?php 
require('head.php'); 
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cancelled Orders</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="order.php">My Orders</a></li>
        <li class="breadcrumb-item active text-white">Cancelled</li>
    </ol>
</div>
<!-- Single Page Header End -->

<div class="container-fluid py-5">
    <div class="container py-5">
<?php
if (!$isLoggedIn) {
?>
    <div class="text-center py-5">
        <i class="fa fa-user-lock fa-4x text-primary mb-3"></i>
        <h2 class="mb-3">Please Sign In to Track Orders</h2>
        <p class="text-muted mb-4">You need an active customer account to view your cancelled catering bookings.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="login.php" class="btn btn-primary rounded-pill py-3 px-5 text-white fs-5">Sign In Now</a>
            <a href="registration.php" class="btn btn-outline-primary rounded-pill py-3 px-5 fs-5">Create Account</a>
        </div>
    </div>
<?php
} else {
    $userEmail = $_SESSION['email'];
    $q = "SELECT * FROM booking WHERE status=3 AND email='" . addslashes($userEmail) . "' ORDER BY bid DESC";
    $info = $dao->query($q);
?>
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 pb-2 border-bottom gap-2">
            <h2 class="h3 mb-0 text-danger"><i class="fa fa-ban me-2"></i>Cancelled Catering Bookings</h2>
            <div class="gap-2 d-flex">
                <a href="order.php" class="btn btn-outline-primary rounded-pill px-3">
                    <i class="fa fa-clock me-1"></i> Active Orders
                </a>
                <a href="delivered.php" class="btn btn-outline-success rounded-pill px-3">
                    <i class="fa fa-truck me-1"></i> Delivered
                </a>
            </div>
        </div>

        <?php if (empty($info)): ?>
            <div class="text-center py-5">
                <div class="p-5 bg-light rounded shadow-sm">
                    <i class="fa fa-check-circle fa-3x text-success mb-3"></i>
                    <h4>No Cancelled Orders</h4>
                    <p class="text-muted">You do not have any cancelled bookings on record.</p>
                    <a href="order.php" class="btn btn-primary rounded-pill px-4 mt-2">View Active Orders</a>
                </div>
            </div>
        <?php else: ?>
            <div class="table-responsive shadow-sm rounded">
                <table class="table align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th style="width: 90px;">Item</th>
                            <th>Description</th>
                            <th style="width: 100px;">Price</th>
                            <th style="width: 80px;">Qty</th>
                            <th style="width: 110px;">Total</th>
                            <th style="width: 120px;">Event Date</th>
                            <th style="width: 140px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        foreach ($info as $ord): 
                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td>
                                    <img src="<?= htmlspecialchars($ord['bimage']) ?>" class="rounded" style="width: 70px; height: 50px; object-fit: cover;" alt="">
                                </td>
                                <td>
                                    <h6 class="mb-0 text-dark"><?= htmlspecialchars($ord['iname']) ?></h6>
                                    <small class="text-muted">Booked: <?= htmlspecialchars($ord['cdate']) ?></small>
                                </td>
                                <td>₹<?= number_format(floatval($ord['price']), 2) ?></td>
                                <td><span class="badge bg-light text-dark border px-2 py-1"><?= htmlspecialchars($ord['quantity']) ?></span></td>
                                <td class="fw-bold text-muted">₹<?= number_format(floatval($ord['total']), 2) ?></td>
                                <td><?= htmlspecialchars($ord['pdate']) ?></td>
                                <td>
                                    <span class="badge bg-danger px-3 py-2 rounded-pill"><i class="fa fa-times me-1"></i> Cancelled</span>
                                </td>
                            </tr>
                        <?php 
                            $i++;
                        endforeach; 
                        ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
<?php 
} 
?>
    </div>
</div>

<?php require('footer.php'); ?>
