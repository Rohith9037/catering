<?php 
require('head.php'); 

$allCategories = $dao->query("SELECT * FROM category WHERE status=1");
$selectedCid = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

if ($selectedCid === 0 && !empty($allCategories)) {
    $selectedCid = intval($allCategories[0]['cid']);
}

$selectedCategoryName = "Items";
foreach ($allCategories as $c) {
    if (intval($c['cid']) === $selectedCid) {
        $selectedCategoryName = $c['cname'];
        break;
    }
}
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6"><?= htmlspecialchars($selectedCategoryName) ?> Dishes</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="submenu.php">Sub Menu</a></li>
        <li class="breadcrumb-item active text-white"><?= htmlspecialchars($selectedCategoryName) ?></li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="row g-4">
            <!-- Sidebar Categories -->
            <div class="col-lg-3">
                <div class="bg-light p-4 rounded shadow-sm">
                    <h4 class="mb-3 pb-2 border-bottom text-primary font-weight-bold">Categories</h4>
                    <ul class="list-unstyled fruite-categorie mb-0">
                        <?php if (!empty($allCategories)): ?>
                            <?php foreach ($allCategories as $cat): 
                                $cCountQ = "SELECT count(*) as item_count FROM item WHERE cid=" . intval($cat['cid']) . " AND status=1";
                                $cCountRes = $dao->query($cCountQ);
                                $item_count = $cCountRes[0]['item_count'] ?? 0;
                                $isActive = (intval($cat['cid']) === $selectedCid);
                            ?>
                                <li class="py-2 border-bottom border-light">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="items.php?id=<?= $cat['cid'] ?>" class="text-decoration-none <?= $isActive ? 'text-primary fw-bold' : 'text-dark' ?>">
                                            <i class="fa fa-utensils me-2 text-primary" style="font-size: 14px;"></i>
                                            <?= htmlspecialchars($cat['cname']) ?>
                                        </a>
                                        <span class="badge rounded-pill <?= $isActive ? 'bg-primary text-white' : 'bg-secondary text-dark' ?>">
                                            <?= $item_count ?>
                                        </span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- Items Grid -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                    <h2 class="h3 mb-0"><?= htmlspecialchars($selectedCategoryName) ?> Menu Items</h2>
                    <a href="submenu.php" class="btn btn-sm btn-outline-secondary">
                        <i class="fa fa-arrow-left me-1"></i> All Categories
                    </a>
                </div>

                <div class="row g-4">
                    <?php
                    $q = "SELECT * FROM item WHERE cid= '$selectedCid' AND status=1";
                    $items = $dao->query($q);

                    if (!empty($items)):
                        foreach ($items as $dish):
                    ?>
                        <div class="col-md-6 col-lg-6 col-xl-4">
                            <div class="rounded position-relative fruite-item h-100 d-flex flex-column shadow-sm bg-white">
                                <div class="fruite-img">
                                    <img src="<?= BASE_URL . 'item_images/' . htmlspecialchars($dish['item_image']); ?>" class="img-fluid w-100 rounded-top" style="height: 200px; object-fit: cover;" alt="<?= htmlspecialchars($dish['item_name']) ?>">
                                </div>
                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Dish</div>
                                <div class="p-4 border border-secondary border-top-0 rounded-bottom d-flex flex-column flex-grow-1">
                                    <h4 class="mb-2"><?= htmlspecialchars($dish['item_name']) ?></h4>
                                    <div class="d-flex justify-content-between align-items-center mt-auto pt-3">
                                        <p class="text-dark fs-5 fw-bold mb-0">₹<?= htmlspecialchars($dish['item_price']) ?></p>
                                        <a  
                                            href="<?= $isLoggedIn ? 'booking_item.php?id=' . $dish['item_id'] : 'login.php' ?>"
                                            class="btn border border-secondary rounded-pill px-3 text-primary">
                                            <i class="fa fa-shopping-bag me-1 text-primary"></i> <?= $isLoggedIn ? 'Add to Cart' : 'Login to Book' ?>
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
                            <div class="p-5 bg-light rounded">
                                <i class="fa fa-utensils fa-3x text-muted mb-3"></i>
                                <h4>No Dishes Available</h4>
                                <p class="text-muted">There are currently no items listed under the <?= htmlspecialchars($selectedCategoryName) ?> category.</p>
                                <a href="submenu.php" class="btn btn-primary rounded-pill px-4 mt-2">Browse Other Categories</a>
                            </div>
                        </div>
                    <?php 
                    endif; 
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->

<?php require('footer.php'); ?>
