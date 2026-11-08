<?php	
include("dbcon.php");
$bid = $_GET['id'];
//$sql = "delete from booking where bid=".$bid;
$sql = "update booking set status=3 where bid=".$bid;
$conn->query($sql);
echo "<script>alert('Ordered Item Cancelled and Refund will be 3 or 4 working days');</script>";
echo"<script>location.href='order.php'</script>";
?>