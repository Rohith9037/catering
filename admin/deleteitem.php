<?php	
include("dbcon.php");
$item_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($item_id > 0) {
    $sql = "UPDATE item SET status=2 WHERE item_id=" . $item_id;
    $conn->query($sql);
}

header('location:itemview.php');
exit;
?>
