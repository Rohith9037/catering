<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("dbcon.php");

if (isset($_GET['id'])) {
    $bid = intval($_GET['id']);
    if ($bid > 0) {
        if (!empty($_SESSION['email'])) {
            $userEmail = addslashes($_SESSION['email']);
            $conn->query("DELETE FROM booking WHERE bid=$bid AND email='$userEmail'");
        } else {
            $conn->query("DELETE FROM booking WHERE bid=$bid");
        }
    }
}

header("Location: cart.php");
exit;
?>