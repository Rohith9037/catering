<?php 
require('../config/autoload.php'); 
$dao = new DataAccess();
$cid = isset($_GET['id']) ? intval($_GET['id']) : 0;
$info = $dao->getData('*', 'category', 'cid=' . $cid);

if (empty($info)) {
    echo "<script>alert('Category not found'); window.location='categoryview.php';</script>";
    exit;
}

$file = new FileUpload();
$elements = array("cname" => $info[0]['cname'], "cimage" => "");
$form = new FormAssist($elements, $_POST);

$labels = array('cname' => "Category Name", 'cimage' => "Category Image");
$rules = array(
    "cname" => array("required" => true, "minlength" => 3, "maxlength" => 30)
);

$validator = new FormValidator($rules, $labels);

$msg = "";
if (isset($_POST["btn_update"])) {
    if ($validator->validate($_POST)) {
        $data = array(
            'cname' => $_POST['cname']
        );

        if (!empty($_FILES['cimage']['name'])) {
            if ($fileName = $file->doUploadRandom($_FILES['cimage'], array('.jpg', '.png', '.jpeg'), 100000, 1, '../category_images')) {
                $data['cimage'] = $fileName;
            } else {
                $msg = $file->errors();
            }
        }

        if (empty($msg)) {
            if ($dao->update($data, 'category', 'cid=' . $cid)) {
                echo "<script>alert('Category updated successfully'); window.location='categoryview.php';</script>";
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
            <h2>Edit Category</h2>
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
                <i class="fa fa-edit"></i> Edit Category Details
            </div>
            <div class="panel-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="cname">Category Name <span style="color:red;">*</span></label>
                        <?= $form->textBox('cname', array('class' => 'form-control', 'id' => 'cname')); ?>
                        <span class="text-danger"><?= $validator->error('cname'); ?></span>
                    </div>

                    <div class="form-group">
                        <label>Current Image</label><br>
                        <?php if (!empty($info[0]['cimage'])): ?>
                            <img src="../category_images/<?= htmlspecialchars($info[0]['cimage']) ?>" style="width: 120px; height: 80px; object-fit: cover; border-radius: 4px; margin-bottom: 10px; border: 1px solid #ddd;" alt="Current Image">
                        <?php endif; ?>
                        <br>
                        <label for="cimage">Upload New Image (Leave empty to keep current)</label>
                        <?= $form->fileField('cimage', array('class' => 'form-control', 'id' => 'cimage', 'accept' => 'image/*')); ?>
                    </div>

                    <div style="margin-top: 25px;">
                        <button type="submit" name="btn_update" class="btn btn-primary btn-lg">
                            <i class="fa fa-save"></i> Update Category
                        </button>
                        <a href="categoryview.php" class="btn btn-default btn-lg" style="margin-left: 10px;">
                            <i class="fa fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
