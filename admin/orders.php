<?php 
require('../config/autoload.php'); 
$dao = new DataAccess();
include('header.php'); 
?>

<div class="row">
    <div class="col-md-12">
        <div class="admin-page-header">
            <h2>Active Orders</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-weight: bold; font-size: 16px;">
                <i class="fa fa-shopping-cart"></i> Confirmed Customer Bookings (Status: Confirmed / In Progress)
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Item / Menu</th>
                                <th style="width: 60px;">Qty</th>
                                <th style="width: 90px;">Total</th>
                                <th>Customer Email</th>
                                <th style="width: 100px;">Image</th>
                                <th style="width: 100px;">Order Date</th>
                                <th style="width: 110px;">Event Date</th>
                                <th style="width: 90px;">Event Time</th>
                                <th style="width: 110px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
    $actions = array(
        'deliver' => array(
            'label' => 'Mark Delivered',
            'link' => 'delivery.php',
            'params' => array('id' => 'bid'),
            'attributes' => array('class' => 'btn btn-success btn-xs', 'onclick' => "return confirm('Mark this order as delivered?');")
        )
    );

    $config = array(
        'srno' => true,
        'hiddenfields' => array('bid'),
        'actions_td' => false,
        'images' => array(
            'field' => 'bimage',
            'path' => '',
            'attributes' => array('style' => 'width:70px; height:50px; object-fit:cover; border-radius:4px;')
        )
    );

    $join = array();  
    $fields = array('bid', 'iname', 'quantity', 'total', 'email', 'bimage', 'cdate', 'pdate', 'btime');
    $orders = $dao->selectAsTable($fields, 'booking as m', 'status=2', $join, $actions, $config);

    if (empty($orders)) {
        echo "<tr><td colspan='10' class='text-center text-muted' style='padding: 30px;'><i class='fa fa-info-circle'></i> No active bookings found at this time.</td></tr>";
    } else {
        echo $orders;
    }
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
