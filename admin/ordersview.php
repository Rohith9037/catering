<?php 
require('../config/autoload.php'); 
include("dbcon.php");
$dao = new DataAccess();

$date1 = isset($_SESSION['fdate']) ? $_SESSION['fdate'] : date('Y-m-d');

include("header.php");
?>

<div class="row">
    <div class="col-md-12">
        <div class="admin-page-header">
            <h2>Bookings for Date: <?= htmlspecialchars($date1) ?></h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span style="font-weight: bold; font-size: 16px;">
                    <i class="fa fa-calendar-check"></i> Orders Scheduled for <?= htmlspecialchars($date1) ?>
                </span>
                <a href="date.php" class="btn btn-default btn-sm pull-right">
                    <i class="fa fa-calendar"></i> Change Date
                </a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Customer Email</th>
                                <th>Item / Menu</th>
                                <th style="width: 70px;">Quantity</th>
                                <th style="width: 100px;">Unit Price (₹)</th>
                                <th style="width: 100px;">Total Price (₹)</th>
                                <th style="width: 110px;">Ordered Date</th>
                                <th style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
    $actions = array(
        'delete' => array(
            'label' => 'Mark Delivered',
            'link' => 'delivery.php',
            'params' => array('id' => 'bid'),
            'attributes' => array('class' => 'btn btn-success btn-xs', 'onclick' => "return confirm('Mark as delivered?');")
        )
    );

    $config = array(
        'srno' => true,
        'hiddenfields' => array('bid'),
        'actions_td' => false
    );

    $condition = "pdate='" . addslashes($date1) . "' and status=2";
    $join = array();  
    $fields = array('bid', 'email', 'iname', 'quantity', 'price', 'total', 'cdate');

    $users = $dao->selectAsTable($fields, 'booking as c', $condition, $join, $actions, $config);
    
    if (empty($users)) {
        echo "<tr><td colspan='8' class='text-center text-muted' style='padding: 30px;'><i class='fa fa-info-circle'></i> No active bookings found for " . htmlspecialchars($date1) . ".</td></tr>";
    } else {
        echo $users;
    }                           
?>
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 20px;">
                    <a href="date.php" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> Select Another Date
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
