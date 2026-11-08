<?php	
include("dbcon.php");
$date = $_GET['date'];
//$sql = "delete from booking where pdate='$date'";
$sql = "update booking set status=3 where pdate='$date'";
$conn->query($sql);
echo "<script>alert('All Item Were Cancelled For Particular Date');</script>";
echo"<script>location.href='order.php'</script>";
?>