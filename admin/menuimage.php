<?php 
require('../config/autoload.php'); 
$dao = new DataAccess();
include('header.php'); 
?>

<div class="row">
    <div class="col-md-12">
        <div class="admin-page-header">
            <h2>All Menu Packages</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span style="font-weight: bold; font-size: 16px;"><i class="fa fa-list-alt"></i> Menu Packages List</span>
                <a href="menu_prj.php" class="btn btn-primary btn-sm pull-right">
                    <i class="fa fa-plus"></i> Add New Menu
                </a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 60px;">#</th>
                                <th>Menu Name</th>
                                <th style="width: 100px;">Price (₹)</th>
                                <th>Description</th>
                                <th style="width: 120px;">Image</th>
                                <th style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
    $actions = array(
        'edit' => array('label' => 'Edit', 'link' => 'editmenu.php', 'params' => array('id' => 'mid'), 'attributes' => array('class' => 'btn btn-primary btn-xs')),
        'delete' => array('label' => 'Delete', 'link' => 'deletemenu.php', 'params' => array('id' => 'mid'), 'attributes' => array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to delete this menu?');"))
    );

    $config = array(
        'srno' => true,
        'hiddenfields' => array('mid'),
        'actions_td' => false,
        'images' => array(
            'field' => 'mimage',
            'path' => '../menu_images/',
            'attributes' => array('style' => 'width:80px; height:60px; object-fit:cover; border-radius:4px;')
        )
    );

    $join = array();  
    $fields = array('mid', 'mname', 'mprice', 'description', 'mimage');
    $menus = $dao->selectAsTable($fields, 'menu as m', "status=1", $join, $actions, $config);

    if (empty($menus)) {
        echo "<tr><td colspan='6' class='text-center text-muted' style='padding: 30px;'>No menus found. Click 'Add New Menu' above to create one.</td></tr>";
    } else {
        echo $menus;
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
