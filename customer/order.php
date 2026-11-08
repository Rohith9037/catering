<?php 
require('head.php'); 
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">My Active Orders</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active text-white">My Orders</li>
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
        <p class="text-muted mb-4">You need an active customer account to view your confirmed catering bookings.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="login.php" class="btn btn-primary rounded-pill py-3 px-5 text-white fs-5">Sign In Now</a>
            <a href="registration.php" class="btn btn-outline-primary rounded-pill py-3 px-5 fs-5">Create Account</a>
        </div>
    </div>
<?php
} else {
    $userEmail = $_SESSION['email'];
    $dateFilter = $_GET['date'] ?? '';

    $sql = "SELECT * FROM booking WHERE status=2 AND email='" . addslashes($userEmail) . "'";
    if (!empty($dateFilter)) {
        $sql .= " AND pdate='" . addslashes($dateFilter) . "'";
    }
    $sql .= " ORDER BY pdate ASC, bid DESC";
    $orders = $dao->query($sql);
?>
        <!-- Filter Bar -->
        <div class="card border-0 bg-light shadow-sm p-4 mb-4 rounded">
            <form method="GET" action="order.php" class="row g-3 align-items-center">
                <div class="col-md-5">
                    <label for="filter_date" class="form-label fw-bold mb-1">
                        <i class="fa fa-calendar-alt text-primary me-1"></i> Filter by Event Date:
                    </label>
                    <input type="date" id="filter_date" name="date" class="form-control" value="<?= htmlspecialchars($dateFilter) ?>">
                </div>
                <div class="col-md-7 d-flex flex-wrap align-items-end gap-2 pt-md-4">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fa fa-filter me-1"></i> Apply Filter
                    </button>
                    <?php if (!empty($dateFilter)): ?>
                        <a href="order.php" class="btn btn-outline-secondary rounded-pill px-3">
                            <i class="fa fa-times me-1"></i> Clear Filter
                        </a>
                    <?php endif; ?>
                    <a href="delivered.php" class="btn btn-outline-success rounded-pill px-3 ms-auto">
                        <i class="fa fa-truck me-1"></i> Delivered (Past)
                    </a>
                    <a href="cancelled.php" class="btn btn-outline-danger rounded-pill px-3">
                        <i class="fa fa-ban me-1"></i> Cancelled
                    </a>
                </div>
            </form>
        </div>

        <?php if (empty($orders)): ?>
            <div class="text-center py-5">
                <img src="img/empty_order.jpg" style="width: 250px; height: auto;" alt="No Orders" class="mb-4 rounded">
                <h3 class="text-dark mb-2">No Active Bookings Found</h3>
                <p class="text-muted mb-4"><?= !empty($dateFilter) ? 'No orders scheduled for ' . htmlspecialchars($dateFilter) . '.' : 'You do not have any active catering bookings at the moment.' ?></p>
                <a href="menu.php" class="btn btn-primary rounded-pill py-3 px-5 text-white">
                    <i class="fa fa-utensils me-2"></i> Explore Our Menus
                </a>
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
                            <th style="width: 110px;">Event Time</th>
                            <th style="width: 130px;">Status</th>
                            <th style="width: 120px;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $idx = 1;
                        foreach ($orders as $ord): 
                        ?>
                            <tr>
                                <td><?= $idx ?></td>
                                <td>
                                    <img src="<?= htmlspecialchars($ord['bimage']) ?>" class="rounded" style="width: 70px; height: 50px; object-fit: cover;" alt="<?= htmlspecialchars($ord['iname']) ?>">
                                </td>
                                <td>
                                    <h6 class="mb-0 text-dark"><?= htmlspecialchars($ord['iname']) ?></h6>
                                    <small class="text-muted">Booked: <?= htmlspecialchars($ord['cdate']) ?></small>
                                </td>
                                <td>₹<?= number_format(floatval($ord['price']), 2) ?></td>
                                <td><span class="badge bg-light text-dark border px-2 py-1"><?= htmlspecialchars($ord['quantity']) ?></span></td>
                                <td class="fw-bold text-primary">₹<?= number_format(floatval($ord['total']), 2) ?></td>
                                <td class="fw-bold text-dark"><i class="fa fa-calendar-day text-primary me-1"></i><?= htmlspecialchars($ord['pdate']) ?></td>
                                <td><i class="fa fa-clock text-muted me-1"></i><?= htmlspecialchars($ord['btime']) ?></td>
                                <td>
                                    <span class="badge bg-primary px-3 py-2 rounded-pill">Confirmed</span>
                                </td>
                                <td class="text-center">
                                    <a href="cancellation.php?id=<?= $ord['bid'] ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Are you sure you want to cancel this booking? Refund will be processed in 3-4 working days.');">
                                        Cancel
                                    </a>
                                </td>
                            </tr>
                        <?php 
                            $idx++;
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
