<?php
session_start();
include '../php/userconfig.php';

$macaddress = $_SESSION['macaddress'];
$sql = "SELECT status FROM plantiq_espconnection WHERE macaddress='$macaddress'";
$run = $conn->query($sql);

if ($run->num_rows > 0) {
    $row = $run->fetch_assoc();
    $currentStatus = $row['status'];

    echo 'Status: ' . $currentStatus;
    echo ($currentStatus == 'Connected') ? '<i class="fa-solid fa-circle text-success"></i>' : '<i class="fa-solid fa-circle text-secondary"></i>';
}

$conn->close();
?>
