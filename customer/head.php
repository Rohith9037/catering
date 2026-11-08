<!DOCTYPE html>
<html lang="en">
<?php 
require_once(__DIR__ . '/../config/autoload.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$dao = new DataAccess();

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

$currentPage = basename($_SERVER['PHP_SELF']);
$isLoggedIn = isset($_SESSION['email']);
$userName = "";
$userLname = "";

if ($isLoggedIn) {
    $userEmail = $_SESSION['email'];
    $uQuery = "SELECT * FROM login WHERE lemail='" . addslashes($userEmail) . "'";
    $uResult = $dao->query($uQuery);
    if (!empty($uResult)) {
        $userName = $uResult[0]['fname'] ?? '';
        $userLname = $uResult[0]['lname'] ?? '';
    }
}

// Calculate active cart count
$item_count = 0;
if ($isLoggedIn) {
    $cartCountQ = "SELECT count(*) as count FROM booking WHERE email='" . addslashes($_SESSION['email']) . "' AND status='1'";
    $cartCountRes = $dao->query($cartCountQ);
    $item_count = $cartCountRes[0]['count'] ?? 0;
}
?>
<head>
    <meta charset="utf-8">
    <title>Chic Catering - Fresh & Delightful Event Catering</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=5.0" name="viewport">
    <meta content="Catering, Event Catering, Wedding Catering, Food Delivery" name="keywords">
    <meta content="Chic Catering provides delicious, hygienic, and memorable catering services for weddings, corporate events, and parties." name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    
    <!-- Mobile App-Like Responsiveness -->
    <link href="css/app-responsive.css" rel="stylesheet">
    
    <style>
        .navbar-brand h1 {
            font-size: 26px;
            margin: 0;
            display: flex;
            align-items: center;
        }
        .navbar-light .navbar-nav .nav-link.active {
            color: #81C408 !important;
            font-weight: 600;
        }
        .cart-badge {
            top: -6px;
            left: 14px;
            height: 20px;
            min-width: 20px;
            font-size: 11px;
            font-weight: bold;
        }
        .user-greeting {
            font-size: 14px;
            color: #495057;
            padding-right: 15px;
            border-right: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <!-- Top Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-lg shadow-sm rounded-bottom py-2 py-lg-3">
                <div class="d-flex align-items-center justify-content-between w-100 px-3 px-lg-0">
                    <!-- Brand -->
                    <a href="index.php" class="navbar-brand py-0 my-0">
                        <h1 class="text-primary display-6 mb-0" style="font-size: clamp(20px, 4vw, 26px);">
                            <i class="fa fa-dove text-primary me-2"></i>Chic Catering
                        </h1>
                    </a>

                    <!-- Mobile Right Actions (Quick Cart + Toggler) -->
                    <div class="d-flex align-items-center d-lg-none">
                        <a href="cart.php" class="position-relative me-3 text-primary text-decoration-none" title="Cart">
                            <i class="fa fa-shopping-bag" style="font-size: 22px;"></i>
                            <?php if ($item_count > 0): ?>
                                <span class="position-absolute bg-primary rounded-circle d-flex align-items-center justify-content-center text-white px-1" style="top: -6px; right: -8px; height: 18px; min-width: 18px; font-size: 10px; font-weight: bold;">
                                    <?= $item_count ?>
                                </span>
                            <?php endif; ?>
                        </a>
                        <button class="navbar-toggler py-2 px-2 border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-label="Toggle navigation">
                            <span class="fa fa-bars text-primary" style="font-size: 22px;"></span>
                        </button>
                    </div>

                    <!-- Collapsible Menu -->
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="index.php" class="nav-item nav-link <?= ($currentPage === 'index.php') ? 'active' : '' ?>">
                                <i class="fa fa-home d-lg-none me-2 text-primary"></i>Home
                            </a>
                            <a href="menu.php" class="nav-item nav-link <?= ($currentPage === 'menu.php') ? 'active' : '' ?>">
                                <i class="fa fa-utensils d-lg-none me-2 text-primary"></i>Main Menu
                            </a>
                            <a href="submenu.php" class="nav-item nav-link <?= (in_array($currentPage, ['submenu.php', 'items.php'])) ? 'active' : '' ?>">
                                <i class="fa fa-th-large d-lg-none me-2 text-primary"></i>Sub Menu
                            </a>
                            
                            <?php if ($isLoggedIn): ?>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle <?= (in_array($currentPage, ['order.php', 'orders.php', 'delivered.php', 'cancelled.php'])) ? 'active' : '' ?>" data-bs-toggle="dropdown">
                                        <i class="fa fa-clipboard-list d-lg-none me-2 text-primary"></i>My Orders
                                    </a>
                                    <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                        <a href="order.php" class="dropdown-item">Active / Booked</a>
                                        <a href="delivered.php" class="dropdown-item">Delivered Orders</a>
                                        <a href="cancelled.php" class="dropdown-item">Cancelled Orders</a>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <a href="service.php" class="nav-item nav-link <?= ($currentPage === 'service.php') ? 'active' : '' ?>">
                                <i class="fa fa-concierge-bell d-lg-none me-2 text-primary"></i>Services
                            </a>
                            <a href="contact.php" class="nav-item nav-link <?= ($currentPage === 'contact.php') ? 'active' : '' ?>">
                                <i class="fa fa-envelope d-lg-none me-2 text-primary"></i>Contact
                            </a>
                        </div>

                        <!-- Desktop Right Actions -->
                        <div class="d-none d-lg-flex align-items-center m-3 me-0">
                            <?php if ($isLoggedIn): ?>
                                <div class="user-greeting me-3 text-end">
                                    <small class="text-muted d-block" style="font-size: 11px;">Hello,</small>
                                    <span class="fw-bold text-dark"><i class="fa fa-user-circle text-primary me-1"></i><?= htmlspecialchars($userName) ?></span>
                                </div>
                                <a href="cart.php" class="position-relative me-4 my-auto text-primary" title="Shopping Cart">
                                    <i class="fa fa-shopping-bag fa-2x"></i>
                                    <?php if ($item_count > 0): ?>
                                        <span class="position-absolute bg-primary rounded-circle d-flex align-items-center justify-content-center text-white px-1 cart-badge">
                                            <?= $item_count ?>
                                        </span>
                                    <?php endif; ?>
                                </a>
                                <a href="index.php?logout=true" class="my-auto text-danger" title="Logout">
                                    <i class="fas fa-sign-out-alt fa-2x"></i>
                                </a>
                            <?php else: ?>
                                <a href="login.php" class="btn btn-outline-primary rounded-pill px-3 py-1 me-2">
                                    <i class="fas fa-sign-in-alt me-1"></i> Login
                                </a>
                                <a href="registration.php" class="btn btn-primary rounded-pill px-3 py-1 text-white">
                                    <i class="fas fa-user-plus me-1"></i> Sign Up
                                </a>
                            <?php endif; ?>
                        </div>

                        <!-- Mobile Dropdown User Details & Actions -->
                        <div class="d-lg-none border-top pt-3 pb-2 mt-2">
                            <?php if ($isLoggedIn): ?>
                                <div class="d-flex justify-content-between align-items-center mb-2 px-2">
                                    <span class="fw-bold text-dark"><i class="fa fa-user-circle text-primary me-2"></i><?= htmlspecialchars($userName . ' ' . $userLname) ?></span>
                                    <a href="index.php?logout=true" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                                    </a>
                                </div>
                            <?php else: ?>
                                <div class="d-flex gap-2 px-2">
                                    <a href="login.php" class="btn btn-outline-primary rounded-pill w-50 py-2">
                                        <i class="fas fa-sign-in-alt me-1"></i> Login
                                    </a>
                                    <a href="registration.php" class="btn btn-primary text-white rounded-pill w-50 py-2">
                                        <i class="fas fa-user-plus me-1"></i> Sign Up
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Top Navbar End -->
