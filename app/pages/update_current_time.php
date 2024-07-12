<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");

date_default_timezone_set('Asia/Manila');
$current_time = date('F j, Y (g:i A)');
echo $current_time;
?>
