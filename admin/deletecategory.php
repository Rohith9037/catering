<?php	
include("dbcon.php");
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "UPDATE category SET status=2 WHERE cid=" . $id;
    $conn->query($sql);
}

header('location:categoryview.php');
exit;
?>
