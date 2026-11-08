<?php 
$dateParam = isset($_GET['date']) ? '?date=' . urlencode($_GET['date']) : '';
header("Location: order.php" . $dateParam);
exit;
?>
