<?php 
require('head.php'); 
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Sub Menu - Categories</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active text-white">Sub Menu</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Sub MENU start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;">
            <h4 class="text-primary font-weight-bold">A La Carte Dishes</h4>
            <h1 class="display-5">Select a Category</h1>
            <p class="text-muted">Explore individual specialty dishes organized by meat, poultry, seafood, and vegetarian options.</p>
        </div>
        <div class="row g-4 justify-content-center"> 
            <?php
            $q = "SELECT * FROM category WHERE status=1";
            $info = $dao->query($q);
            if (!empty($info)):
                foreach ($info as $cat):
                    $countQ = "SELECT count(*) as count FROM item WHERE cid=" . intval($cat['cid']) . " AND status=1";
                    $countRes = $dao->query($countQ);
                    $dishCount = $countRes[0]['count'] ?? 0;
            ?>
                <div class="col-md-6 col-lg-4 col-xl-3"> 
                    <div class="rounded position-relative fruite-item h-100 d-flex flex-column shadow-sm bg-white">
                        <div class="fruite-img">
                            <img src="<?= BASE_URL . 'category_images/' . htmlspecialchars($cat['cimage']); ?>" class="img-fluid w-100 rounded-top" style="height: 220px; object-fit: cover;" alt="<?= htmlspecialchars($cat['cname']) ?>">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom d-flex flex-column flex-grow-1">
                            <h4 class="mb-1"><?= htmlspecialchars($cat['cname']) ?></h4>
                            <p class="text-muted small mb-3"><?= $dishCount ?> delicious dishes available</p>
                            <div class="mt-auto">
                                <a href="items.php?id=<?= $cat['cid'] ?>" class="btn btn-outline-primary rounded-pill w-100 py-2">
                                    <i class="fa fa-eye me-2 text-primary"></i> View <?= htmlspecialchars($cat['cname']) ?> Items
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
                    <p class="text-muted fs-4">No categories currently found.</p>
                </div>
            <?php
            endif;
            ?>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->

<?php require('footer.php'); ?>
