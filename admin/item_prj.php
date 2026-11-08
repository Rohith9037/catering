<?php 
require('../config/autoload.php'); 

$file = new FileUpload();
$elements = array(
    "item_name" => "", "item_image" => "", "item_price" => "", "cid" => ""
);

$form = new FormAssist($elements, $_POST);
$dao = new DataAccess();

$labels = array('item_name' => "Item Name", 'item_image' => "Item Image", 'item_price' => "Price", "cid" => "Category Name");
$rules = array(
    "item_name" => array("required" => true, "minlength" => 3, "maxlength" => 30),
    "cid" => array("required" => true),
    "item_image" => array('filerequired' => true),
    "item_price" => array("required" => true, "minlength" => 2, "maxlength" => 6, "integeronly" => true)     
);

$validator = new FormValidator($rules, $labels);

$msg = "";
if (isset($_POST["btn_insert"])) {
    if ($validator->validate($_POST)) {
        if ($fileName = $file->doUploadRandom($_FILES['item_image'], array('.jpg', '.png', '.jpeg'), 100000, 1, '../item_images')) {
            $data = array(
                'item_name' => $_POST['item_name'],
                'item_image' => $fileName,
                'cid' => $_POST['cid'],
                'item_price' => $_POST['item_price'],
            );
            if ($dao->insert($data, "item")) {
                echo "<script>alert('New item added successfully'); window.location='itemview.php';</script>";
                exit;
            } else {
                $msg = "Database insert failed";
            }
        } else {
            $msg = $file->errors();
        }
    }
}

include("header.php");
?>

<div class="row">
    <div class="col-md-12">
        <div class="admin-page-header">
            <h2>Add New Menu Item</h2>
        </div>
    </div>
</div>

<?php if (!empty($msg)): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Notice:</strong> <?= htmlspecialchars($msg) ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-weight: bold; font-size: 16px;">
                <i class="fa fa-plus-circle"></i> Item Details
            </div>
            <div class="panel-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="item_name">Item Name <span style="color:red;">*</span></label>
                        <?= $form->textBox('item_name', array('class' => 'form-control', 'id' => 'item_name', 'placeholder' => 'Enter item name (e.g. Chicken Biryani, Fish Fry)')); ?>
                        <span class="text-danger"><?= $validator->error('item_name'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="cid">Category <span style="color:red;">*</span></label>
                        <?php
                            $options = $dao->createOptions('cname', 'cid', "category", "status=1");
                            echo $form->dropDownList('cid', array('class' => 'form-control', 'id' => 'cid'), $options);
                        ?>
                        <span class="text-danger"><?= $validator->error('cid'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="item_price">Price (₹) <span style="color:red;">*</span></label>
                        <?= $form->textBox('item_price', array('class' => 'form-control', 'id' => 'item_price', 'placeholder' => 'Enter item price in Rupees')); ?>
                        <span class="text-danger"><?= $validator->error('item_price'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="item_image">Item Image <span style="color:red;">*</span></label>
                        <?= $form->fileField('item_image', array('class' => 'form-control', 'id' => 'item_image', 'accept' => 'image/*')); ?>
                        <span class="text-danger"><?= $validator->error('item_image'); ?></span>
                        <p class="help-block">Accepted formats: JPG, JPEG, PNG. Max size: 2MB.</p>
                    </div>

                    <div style="margin-top: 25px;">
                        <button type="submit" name="btn_insert" class="btn btn-success btn-lg">
                            <i class="fa fa-check"></i> Save Item
                        </button>
                        <a href="itemview.php" class="btn btn-default btn-lg" style="margin-left: 10px;">
                            <i class="fa fa-list"></i> View All Items
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
