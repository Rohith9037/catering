<?php 
require('../config/autoload.php'); 
$dao = new DataAccess();
include('header.php'); 
?>

<div class="row">
    <div class="col-md-12">
        <div class="admin-page-header">
            <h2>Cancelled Orders</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-weight: bold; font-size: 16px;">
                <i class="fa fa-ban"></i> Cancelled Customer Orders (Status: Cancelled)
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
                            </tr>
                        </thead>
                        <tbody>
<?php
    $actions = array();
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
    $cancelled = $dao->selectAsTable($fields, 'booking as m', 'status=3', $join, $actions, $config);

    if (empty($cancelled)) {
        echo "<tr><td colspan='9' class='text-center text-muted' style='padding: 30px;'><i class='fa fa-info-circle'></i> No cancelled orders recorded.</td></tr>";
    } else {
        echo $cancelled;
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
