<?php 
require('../config/autoload.php'); 
$dao = new DataAccess();
$item_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$info = $dao->getData('*', 'item', 'item_id=' . $item_id);

if (empty($info)) {
    echo "<script>alert('Item not found'); window.location='itemview.php';</script>";
    exit;
}

$file = new FileUpload();
$elements = array(
    "item_name" => $info[0]['item_name'], 
    "item_image" => "", 
    "item_price" => $info[0]['item_price'],
    "cid" => $info[0]['cid']
);

$form = new FormAssist($elements, $_POST);

$labels = array('item_name' => "Item Name", 'item_image' => "Item Image", 'item_price' => "Price", 'cid' => "Category");
$rules = array(
    "item_name" => array("required" => true, "minlength" => 3, "maxlength" => 30),
    "item_price" => array("required" => true, "minlength" => 2, "maxlength" => 6, "integeronly" => true)
);

$validator = new FormValidator($rules, $labels);

$msg = "";
if (isset($_POST["btn_update"])) {
    if ($validator->validate($_POST)) {
        $data = array(
            'item_name' => $_POST['item_name'],
            'item_price' => $_POST['item_price'],
            'cid' => $_POST['cid']
        );

        if (!empty($_FILES['item_image']['name'])) {
            if ($fileName = $file->doUploadRandom($_FILES['item_image'], array('.jpg', '.png', '.jpeg'), 100000, 1, '../item_images')) {
                $data['item_image'] = $fileName;
            } else {
                $msg = $file->errors();
            }
        }

        if (empty($msg)) {
            if ($dao->update($data, 'item', 'item_id=' . $item_id)) {
                echo "<script>alert('Item updated successfully'); window.location='itemview.php';</script>";
                exit;
            } else {
                $msg = "Update failed or no changes made";
            }
        }
    }
}

include("header.php");
?>

<div class="row">
    <div class="col-md-12">
        <div class="admin-page-header">
            <h2>Edit Menu Item</h2>
        </div>
    </div>
</div>

<?php if (!empty($msg)): ?>
    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?= htmlspecialchars($msg) ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-weight: bold; font-size: 16px;">
                <i class="fa fa-edit"></i> Edit Item Details
            </div>
            <div class="panel-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="item_name">Item Name <span style="color:red;">*</span></label>
                        <?= $form->textBox('item_name', array('class' => 'form-control', 'id' => 'item_name')); ?>
                        <span class="text-danger"><?= $validator->error('item_name'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="cid">Category <span style="color:red;">*</span></label>
                        <?php
                            $options = $dao->createOptions('cname', 'cid', "category", "status=1");
                            echo $form->dropDownList('cid', array('class' => 'form-control', 'id' => 'cid'), $options);
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="item_price">Price (₹) <span style="color:red;">*</span></label>
                        <?= $form->textBox('item_price', array('class' => 'form-control', 'id' => 'item_price')); ?>
                        <span class="text-danger"><?= $validator->error('item_price'); ?></span>
                    </div>

                    <div class="form-group">
                        <label>Current Image</label><br>
                        <?php if (!empty($info[0]['item_image'])): ?>
                            <img src="../item_images/<?= htmlspecialchars($info[0]['item_image']) ?>" style="width: 120px; height: 80px; object-fit: cover; border-radius: 4px; margin-bottom: 10px; border: 1px solid #ddd;" alt="Current Image">
                        <?php endif; ?>
                        <br>
                        <label for="item_image">Upload New Image (Leave empty to keep current)</label>
                        <?= $form->fileField('item_image', array('class' => 'form-control', 'id' => 'item_image', 'accept' => 'image/*')); ?>
                    </div>

                    <div style="margin-top: 25px;">
                        <button type="submit" name="btn_update" class="btn btn-primary btn-lg">
                            <i class="fa fa-save"></i> Update Item
                        </button>
                        <a href="itemview.php" class="btn btn-default btn-lg" style="margin-left: 10px;">
                            <i class="fa fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
