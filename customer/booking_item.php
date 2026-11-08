<?php 
require('head.php'); 

if (!$isLoggedIn) {
    echo "<script>alert('Please log in to add this item to your cart.'); window.location='login.php';</script>";
    exit;
}

include("dbcon.php");

$itemId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$itemData = $dao->query("SELECT * FROM item WHERE item_id = " . $itemId);

if (empty($itemData)) {
    echo "<script>alert('Dish item not found.'); window.location='submenu.php';</script>";
    exit;
}

$dish = $itemData[0];

if (isset($_POST["btn_insert"])) {
    $userEmail = $_SESSION['email'];
    $imagepath = BASE_URL . "item_images/" . $dish["item_image"]; 
    $iname = $dish["item_name"];
    $price = floatval($dish["item_price"]);
    $qty = intval($_POST["qty"] ?? 1);
    if ($qty < 1) $qty = 1;
    $date1 = date('Y-m-d');
    $pdate = $_POST["pdate"] ?? date('Y-m-d');
    $time = $_POST["tme"] ?? '12:00';
    $total = $qty * $price;

    $sql = "INSERT INTO booking(item_id, email, bimage, iname, quantity, price, total, cdate, pdate, btime, status) 
            VALUES ('$itemId', '" . addslashes($userEmail) . "', '" . addslashes($imagepath) . "', '" . addslashes($iname) . "', '$qty', '$price', '$total', '$date1', '" . addslashes($pdate) . "', '" . addslashes($time) . "', 1)";
    $conn->query($sql);

    echo "<script>location.href = 'cart.php';</script>";
    exit;
}
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Add Dish to Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="submenu.php">Sub Menu</a></li>
        <li class="breadcrumb-item"><a href="items.php?id=<?= $dish['cid'] ?>">Dishes</a></li>
        <li class="breadcrumb-item active text-white"><?= htmlspecialchars($dish["item_name"]) ?></li>
    </ol>
</div>
<!-- Single Page Header End -->

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow border-0 rounded overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-5 bg-light d-flex flex-column align-items-center justify-content-center p-4">
                            <img src="<?= BASE_URL . 'item_images/' . htmlspecialchars($dish['item_image']); ?>" class="img-fluid rounded shadow-sm mb-3" style="max-height: 280px; width: 100%; object-fit: cover;" alt="<?= htmlspecialchars($dish['item_name']) ?>" />
                            <div class="text-center">
                                <h3 class="text-primary mb-1"><?= htmlspecialchars($dish["item_name"]) ?></h3>
                                <p class="text-muted small mb-0">Category ID: #<?= htmlspecialchars($dish["cid"]) ?></p>
                            </div>
                        </div>
                        <div class="col-md-7 p-4 p-lg-5">
                            <h3 class="mb-4 pb-2 border-bottom">Order Details</h3>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="dish_price" class="form-label fw-bold">Unit Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="text" id="dish_price" class="form-control bg-light" value="<?= htmlspecialchars($dish["item_price"]) ?>" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="dish_qty" class="form-label fw-bold">Quantity (Portions / Servings) <span class="text-danger">*</span></label>
                                    <input type="number" id="dish_qty" name="qty" class="form-control" min="1" value="10" required oninput="calcItemTotal()">
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="pdate" class="form-label fw-bold">Event / Delivery Date <span class="text-danger">*</span></label>
                                        <input type="date" id="pdate" name="pdate" class="form-control" required min="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d', strtotime('+1 day')); ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="tme" class="form-label fw-bold">Delivery Time <span class="text-danger">*</span></label>
                                        <input type="time" id="tme" name="tme" class="form-control" required value="12:00">
                                    </div>
                                </div>

                                <div class="alert alert-secondary d-flex justify-content-between align-items-center mt-3">
                                    <span class="fw-bold">Subtotal:</span>
                                    <span class="fs-4 text-primary fw-bold" id="item_est_total">₹<?= number_format(floatval($dish["item_price"]) * 10, 2) ?></span>
                                </div>

                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" name="btn_insert" class="btn btn-primary btn-lg rounded-pill text-white py-3">
                                        <i class="fa fa-shopping-bag me-2"></i> Add Dish to Cart
                                    </button>
                                    <a href="items.php?id=<?= $dish['cid'] ?>" class="btn btn-outline-secondary rounded-pill py-2">
                                        <i class="fa fa-arrow-left me-1"></i> Back to Dishes
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function calcItemTotal() {
    var price = <?= floatval($dish["item_price"]) ?>;
    var qty = parseInt(document.getElementById("dish_qty").value) || 0;
    var total = price * qty;
    document.getElementById("item_est_total").innerText = '₹' + total.toFixed(2);
}
</script>

<?php require('footer.php'); ?>
