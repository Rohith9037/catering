<?php 
require('../config/autoload.php'); 

$file = new FileUpload();
$elements = array(
    "mname" => "", "mimage" => "", "mprice" => "", "description" => ""
);

$form = new FormAssist($elements, $_POST);
$dao = new DataAccess();

$labels = array('mname' => "Menu Name", 'mimage' => "Menu Image", 'mprice' => "Price", 'description' => "Menu Description");
$rules = array(
    "mname" => array("required" => true, "minlength" => 3, "maxlength" => 30),
    "mimage" => array('filerequired' => true),
    "mprice" => array("required" => true, "minlength" => 2, "maxlength" => 6, "integeronly" => true),
    "description" => array("required" => true)     
);

$validator = new FormValidator($rules, $labels);

$msg = "";
if (isset($_POST["btn_insert"])) {
    if ($validator->validate($_POST)) {
        if ($fileName = $file->doUploadRandom($_FILES['mimage'], array('.jpg', '.png', '.jpeg'), 100000, 1, '../menu_images')) {
            $data = array(
                'mname' => $_POST['mname'],
                'mimage' => $fileName,
                'mprice' => $_POST['mprice'],
                'description' => $_POST['description'],
            );
            if ($dao->insert($data, "menu")) {
                echo "<script>alert('New menu package added successfully'); window.location='menuimage.php';</script>";
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
            <h2>Add New Menu Package</h2>
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
                <i class="fa fa-utensils"></i> Menu Package Details
            </div>
            <div class="panel-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="mname">Menu Name <span style="color:red;">*</span></label>
                        <?= $form->textBox('mname', array('class' => 'form-control', 'id' => 'mname', 'placeholder' => 'Enter menu title (e.g. Wedding Feast, Sadhya)')); ?>
                        <span class="text-danger"><?= $validator->error('mname'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="mprice">Price (₹) <span style="color:red;">*</span></label>
                        <?= $form->textBox('mprice', array('class' => 'form-control', 'id' => 'mprice', 'placeholder' => 'Enter price per plate / unit')); ?>
                        <span class="text-danger"><?= $validator->error('mprice'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="description">Description <span style="color:red;">*</span></label>
                        <?= $form->textArea('description', array('class' => 'form-control', 'id' => 'description', 'rows' => '3', 'placeholder' => 'Enter description of menu items included')); ?>
                        <span class="text-danger"><?= $validator->error('description'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="mimage">Menu Image <span style="color:red;">*</span></label>
                        <?= $form->fileField('mimage', array('class' => 'form-control', 'id' => 'mimage', 'accept' => 'image/*')); ?>
                        <span class="text-danger"><?= $validator->error('mimage'); ?></span>
                        <p class="help-block">Accepted formats: JPG, JPEG, PNG. Max size: 2MB.</p>
                    </div>

                    <div style="margin-top: 25px;">
                        <button type="submit" name="btn_insert" class="btn btn-success btn-lg">
                            <i class="fa fa-check"></i> Save Menu
                        </button>
                        <a href="menuimage.php" class="btn btn-default btn-lg" style="margin-left: 10px;">
                            <i class="fa fa-list"></i> View All Menus
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
