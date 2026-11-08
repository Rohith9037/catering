<?php 
if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel - Chic Catering</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <style>
        .admin-page-header {
            margin-bottom: 25px;
            padding-bottom: 12px;
            border-bottom: 2px solid #81C408;
        }
        .admin-page-header h2 {
            margin: 0;
            font-weight: 700;
            color: #333;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 24px;
        }
        .panel-primary > .panel-heading {
            background-color: #202020;
            border-color: #202020;
        }
        .table > thead > tr > th {
            background-color: #f5f5f5;
            color: #333;
            font-weight: 600;
            text-align: center;
            vertical-align: middle;
        }
        .table > tbody > tr > td {
            text-align: center;
            vertical-align: middle;
        }
        .admin-top-actions {
            color: white;
            padding: 15px 30px 5px 30px;
            float: right;
            font-size: 16px;
        }
        @media (max-width: 768px) {
            .admin-top-actions {
                padding: 10px 15px !important;
                float: right !important;
            }
            .admin-top-actions .btn {
                padding: 5px 10px;
                font-size: 12px;
            }
            .admin-page-header h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="menu_prj.php" style="background: #81C408; font-weight: bold; letter-spacing: 1px;">Chic Admin</a> 
            </div>
            <div class="admin-top-actions">  
                <a href="../customer/index.php" target="_blank" class="btn btn-info square-btn-adjust" style="margin-right: 8px;">
                    <i class="fa fa-external-link-alt"></i> <span class="hidden-xs">View Site</span>
                </a>
                <a href="index.php" class="btn btn-danger square-btn-adjust">
                    <i class="fa fa-sign-out-alt"></i> <span class="hidden-xs">Logout</span>
                </a> 
            </div>
        </nav>   
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center" style="padding: 20px 0; background: #202020;">
                        <img src="assets/img/find_user.png" class="user-image img-responsive" alt="Admin" style="margin: 0 auto; width: 80px; border-radius: 50%;"/>
                        <h4 style="color: #fff; margin-top: 10px;">Administrator</h4>
                    </li>
                    <li>
                        <a href="menu_prj.php"><i class="fa fa-utensils fa-2x"></i> Add Menu</a>
                    </li>
                    <li>
                        <a href="menuimage.php"><i class="fa fa-list-alt fa-2x"></i> View Menu</a>
                    </li>
                    <li>
                        <a href="category.php"><i class="fa fa-tags fa-2x"></i> Add Category</a>
                    </li>
                    <li>
                        <a href="categoryview.php"><i class="fa fa-list fa-2x"></i> View Category</a>
                    </li>
                    <li>
                        <a href="item_prj.php"><i class="fa fa-plus-circle fa-2x"></i> Add Item</a>
                    </li>
                    <li>
                        <a href="itemview.php"><i class="fa fa-eye fa-2x"></i> View Item</a>
                    </li>
                    <li>
                        <a href="orders.php"><i class="fa fa-shopping-cart fa-2x"></i> Orders</a>
                    </li>
                    <li>
                        <a href="cancelled.php"><i class="fa fa-ban fa-2x"></i> Cancelled Orders</a>
                    </li>
                    <li>
                        <a href="delivered.php"><i class="fa fa-truck fa-2x"></i> Delivered Orders</a>
                    </li>
                    <li>
                        <a href="date.php"><i class="fa fa-calendar fa-2x"></i> Datewise Report</a>
                    </li>
                </ul>
            </div>
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
