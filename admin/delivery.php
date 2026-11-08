<?php	
include("dbcon.php");
$cartid = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($cartid > 0) {
    $sql = "UPDATE booking SET status=4 WHERE bid=" . $cartid;
    $conn->query($sql);
}

// Redirect back to referring page or orders.php
$redirect = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'orders.php';
echo "<script>location.href = '" . addslashes($redirect) . "';</script>";
?>
