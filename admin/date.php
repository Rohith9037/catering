<?php 
require('../config/autoload.php'); 

$elements = array("fdate" => "");
$form = new FormAssist($elements, $_POST);
$dao = new DataAccess();

$labels = array("fdate" => "Event Date");
$rules = array(
    "fdate" => array('required' => true)
);

$validator = new FormValidator($rules, $labels);

if (isset($_POST["btn_insert"])) {
    if ($validator->validate($_POST)) {
        $_SESSION['fdate'] = $_POST['fdate'];
        echo "<script>location.href='ordersview.php';</script>";
        exit;
    }
}

include("header.php");
?>

<div class="row">
    <div class="col-md-12">
        <div class="admin-page-header">
            <h2>Datewise Bookings Report</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-weight: bold; font-size: 16px;">
                <i class="fa fa-calendar"></i> Select Program Date
            </div>
            <div class="panel-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="fdate">Event / Program Date <span style="color:red;">*</span></label>
                        <?= $form->inputBox('fdate', array('class' => 'form-control', 'id' => 'fdate'), "date") ?>
                        <span class="text-danger"><?= $validator->error('fdate'); ?></span>
                        <p class="help-block">Select the event date to view scheduled catering orders.</p>
                    </div>

                    <div style="margin-top: 20px;">
                        <button type="submit" name="btn_insert" class="btn btn-primary btn-lg">
                            <i class="fa fa-search"></i> View Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
