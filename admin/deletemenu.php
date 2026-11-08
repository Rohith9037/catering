<?php	
include("dbcon.php");
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "UPDATE menu SET status=2 WHERE mid=" . $id;
    $conn->query($sql);
}

header('location:menuimage.php');
exit;
?>
