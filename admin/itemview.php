<?php 
require('../config/autoload.php'); 
$dao = new DataAccess();
include('header.php'); 
?>

<div class="row">
    <div class="col-md-12">
        <div class="admin-page-header">
            <h2>All Menu Items</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span style="font-weight: bold; font-size: 16px;"><i class="fa fa-eye"></i> Menu Items List</span>
                <a href="item_prj.php" class="btn btn-primary btn-sm pull-right">
                    <i class="fa fa-plus"></i> Add New Item
                </a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 60px;">#</th>
                                <th>Item Name</th>
                                <th style="width: 100px;">Price (₹)</th>
                                <th style="width: 120px;">Image</th>
                                <th style="width: 120px;">Category</th>
                                <th style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
    $actions = array(
        'edit' => array('label' => 'Edit', 'link' => 'edititem.php', 'params' => array('id' => 'item_id'), 'attributes' => array('class' => 'btn btn-primary btn-xs')),
        'delete' => array('label' => 'Delete', 'link' => 'deleteitem.php', 'params' => array('id' => 'item_id'), 'attributes' => array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to delete this item?');"))
    );

    $config = array(
        'srno' => true,
        'hiddenfields' => array('item_id'),
        'actions_td' => false,
        'images' => array(
            'field' => 'item_image',
            'path' => '../item_images/',
            'attributes' => array('style' => 'width:80px; height:60px; object-fit:cover; border-radius:4px;')
        )
    );

    $join = array();  
    $fields = array('item_id', 'item_name', 'item_price', 'item_image', 'cid');
    $items = $dao->selectAsTable($fields, 'item as m', 'status=1', $join, $actions, $config);

    if (empty($items)) {
        echo "<tr><td colspan='6' class='text-center text-muted' style='padding: 30px;'>No items found. Click 'Add New Item' above to create one.</td></tr>";
    } else {
        echo $items;
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
