<?php
session_start();
include '../php/userconfig.php';

// Set the timezone to Manila (UTC+8)
date_default_timezone_set('Asia/Manila');

// Get parameters from the ESP
$macAddress = $_GET['macaddress'];
$status = $_GET['status'];

// Get the current time in the desired format (yy-mm-dd hour-minute-second)
$currenttime = date('y-m-d H-i-s');

// Update device status in the database
$sqlUpdate = "UPDATE plantiq_espconnection SET status = '$status', timestamp = '$currenttime' WHERE macaddress = '$macAddress'";
if ($conn->query($sqlUpdate) === TRUE) {
    echo "Status updated successfully";
} else {
    echo "Error updating status: " . $conn->error;
}

$conn->close();
?>
