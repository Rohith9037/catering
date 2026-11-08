<?php 
require('../config/autoload.php'); 
$dao = new DataAccess();
$mid = isset($_GET['id']) ? intval($_GET['id']) : 0;
$info = $dao->getData('*', 'menu', 'mid=' . $mid);

if (empty($info)) {
    echo "<script>alert('Menu package not found'); window.location='menuimage.php';</script>";
    exit;
}

$file = new FileUpload();
$elements = array(
    "mname" => $info[0]['mname'], 
    "mimage" => "", 
    "mprice" => $info[0]['mprice'], 
    "description" => $info[0]['description']
);

$form = new FormAssist($elements, $_POST);

$labels = array('mname' => "Menu Name", 'mimage' => "Menu Image", 'mprice' => "Price", 'description' => "Menu Description");
$rules = array(
    "mname" => array("required" => true, "minlength" => 3, "maxlength" => 30),
    "mprice" => array("required" => true, "minlength" => 2, "maxlength" => 6, "integeronly" => true),
    "description" => array("required" => true)     
);

$validator = new FormValidator($rules, $labels);

$msg = "";
if (isset($_POST["btn_update"])) {
    if ($validator->validate($_POST)) {
        $data = array(
            'mname' => $_POST['mname'],
            'mprice' => $_POST['mprice'],
            'description' => $_POST['description'],
        );

        if (!empty($_FILES['mimage']['name'])) {
            if ($fileName = $file->doUploadRandom($_FILES['mimage'], array('.jpg', '.png', '.jpeg'), 100000, 1, '../menu_images')) {
                $data['mimage'] = $fileName;
            } else {
                $msg = $file->errors();
            }
        }

        if (empty($msg)) {
            if ($dao->update($data, 'menu', 'mid=' . $mid)) {
                echo "<script>alert('Menu package updated successfully'); window.location='menuimage.php';</script>";
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
            <h2>Edit Menu Package</h2>
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
                <i class="fa fa-edit"></i> Edit Menu Details
            </div>
            <div class="panel-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="mname">Menu Name <span style="color:red;">*</span></label>
                        <?= $form->textBox('mname', array('class' => 'form-control', 'id' => 'mname')); ?>
                        <span class="text-danger"><?= $validator->error('mname'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="mprice">Price (₹) <span style="color:red;">*</span></label>
                        <?= $form->textBox('mprice', array('class' => 'form-control', 'id' => 'mprice')); ?>
                        <span class="text-danger"><?= $validator->error('mprice'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="description">Description <span style="color:red;">*</span></label>
                        <?= $form->textArea('description', array('class' => 'form-control', 'id' => 'description', 'rows' => '3')); ?>
                        <span class="text-danger"><?= $validator->error('description'); ?></span>
                    </div>

                    <div class="form-group">
                        <label>Current Image</label><br>
                        <?php if (!empty($info[0]['mimage'])): ?>
                            <img src="../menu_images/<?= htmlspecialchars($info[0]['mimage']) ?>" style="width: 120px; height: 80px; object-fit: cover; border-radius: 4px; margin-bottom: 10px; border: 1px solid #ddd;" alt="Current Image">
                        <?php endif; ?>
                        <br>
                        <label for="mimage">Upload New Image (Leave empty to keep current)</label>
                        <?= $form->fileField('mimage', array('class' => 'form-control', 'id' => 'mimage', 'accept' => 'image/*')); ?>
                    </div>

                    <div style="margin-top: 25px;">
                        <button type="submit" name="btn_update" class="btn btn-primary btn-lg">
                            <i class="fa fa-save"></i> Update Menu
                        </button>
                        <a href="menuimage.php" class="btn btn-default btn-lg" style="margin-left: 10px;">
                            <i class="fa fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
