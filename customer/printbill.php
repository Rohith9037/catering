<?php 
require('../config/autoload.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("dbcon.php");

$dao = new DataAccess();
$userEmail = $_SESSION['email'] ?? '';

if (empty($userEmail)) {
    header('location:login.php');
    exit;
}

// If coming from payment confirmation
if (isset($_GET['order'])) {
    $sqlUpdate = "UPDATE booking SET status=2 WHERE email='" . addslashes($userEmail) . "' AND status=1";
    $conn->query($sqlUpdate);
}

// Fetch active or latest confirmed orders for this user
$today = date('Y-m-d');
$sql = "SELECT * FROM booking WHERE email='" . addslashes($userEmail) . "' AND status=2 ORDER BY bid DESC LIMIT 10";
$result = $conn->query($sql);

$custName = ($_SESSION['fname'] ?? 'Valued') . ' ' . ($_SESSION['lname'] ?? 'Customer');
$custAddr = $_SESSION['address'] ?? 'Kochi, Kerala';
$custCity = $_SESSION['city'] ?? 'Kochi';
$custPhone = $_SESSION['mobile'] ?? 'N/A';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Booking Invoice - Chic Catering</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding: 30px 15px;
        }
        .bill-container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            border: 1px solid #e9ecef;
        }
        .bill-header {
            border-bottom: 2px solid #81C408;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            .bill-container {
                box-shadow: none;
                border: 0;
                padding: 20px 0;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

<div class="bill-container">
    <div class="bill-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-primary mb-1" style="font-size: 28px;">
                <i class="fa fa-dove me-2"></i>Chic Catering
            </h1>
            <p class="text-muted mb-0 small">Official Event Booking Receipt & Tax Invoice</p>
        </div>
        <div class="text-end">
            <span class="badge bg-success fs-6 mb-1">Confirmed & Paid</span>
            <p class="text-muted small mb-0">Invoice Date: <strong><?= date("d M Y") ?></strong></p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <h6 class="text-uppercase text-muted small fw-bold">Service Provider</h6>
            <h5 class="mb-1 text-dark">Chic Catering Ltd.</h5>
            <p class="text-muted small mb-0">
                Muthoot Plaza, 12th Floor, Kacheripady<br>
                Kochi, Kerala 682018<br>
                Phone: +91 6841234567<br>
                Email: contact@chiccatering.in
            </p>
        </div>
        <div class="col-sm-6 text-sm-end">
            <h6 class="text-uppercase text-muted small fw-bold">Billed & Delivered To</h6>
            <h5 class="mb-1 text-dark"><?= htmlspecialchars($custName) ?></h5>
            <p class="text-muted small mb-0">
                <?= htmlspecialchars($custAddr) ?><br>
                <?= htmlspecialchars($custCity) ?>, India<br>
                Phone: <?= htmlspecialchars($custPhone) ?><br>
                Email: <?= htmlspecialchars($userEmail) ?>
            </p>
        </div>
    </div>

    <div class="table-responsive mb-4">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item / Package Description</th>
                    <th scope="col">Event Date</th>
                    <th scope="col" class="text-center">Quantity</th>
                    <th scope="col" class="text-end">Unit Price</th>
                    <th scope="col" class="text-end">Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $grandTotal = 0;
                $idx = 1;
                if ($result && $result->num_rows > 0):
                    while ($row = $result->fetch_assoc()):
                        $grandTotal += floatval($row["total"]);
                ?>
                    <tr>
                        <td><?= $idx ?></td>
                        <td class="fw-bold"><?= htmlspecialchars($row["iname"]) ?></td>
                        <td><?= htmlspecialchars($row["pdate"]) ?> (<?= htmlspecialchars($row["btime"]) ?>)</td>
                        <td class="text-center"><?= htmlspecialchars($row["quantity"]) ?></td>
                        <td class="text-end">₹<?= number_format(floatval($row["price"]), 2) ?></td>
                        <td class="text-end fw-bold">₹<?= number_format(floatval($row["total"]), 2) ?></td>
                    </tr>
                <?php 
                        $idx++;
                    endwhile;
                else:
                ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No recent bookings recorded.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-end">Subtotal</th>
                    <td class="text-end fw-bold">₹<?= number_format($grandTotal, 2) ?></td>
                </tr>
                <tr>
                    <th colspan="5" class="text-end">Delivery & Onsite Setup</th>
                    <td class="text-end text-success fw-bold">FREE</td>
                </tr>
                <tr class="table-light">
                    <th colspan="5" class="text-end fs-5">Total Amount Paid</th>
                    <td class="text-end fs-5 fw-bold text-primary">₹<?= number_format($grandTotal, 2) ?></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="border-top pt-3 text-center text-muted small">
        <p class="mb-1">Thank you for choosing Chic Catering for your special occasion!</p>
        <p class="mb-0">Our team will contact you prior to the program date to confirm on-site logistics.</p>
    </div>

    <div class="no-print mt-4 pt-3 border-top d-flex justify-content-center gap-3">
        <button class="btn btn-primary rounded-pill px-4 py-2" onclick="window.print();">
            <i class="fa fa-print me-1"></i> Print / Save as PDF
        </button>
        <a href="order.php" class="btn btn-outline-primary rounded-pill px-4 py-2">
            <i class="fa fa-list me-1"></i> View My Orders
        </a>
        <a href="index.php" class="btn btn-outline-secondary rounded-pill px-4 py-2">
            <i class="fa fa-home me-1"></i> Return Home
        </a>
    </div>
</div>

</body>
</html>
