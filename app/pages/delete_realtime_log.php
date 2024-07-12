<?php
include '../php/userconfig.php';

$sql = "DELETE FROM plantiq_realtime_log";
$run = $conn->query($sql);
?>