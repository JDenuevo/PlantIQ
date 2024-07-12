<?php
include '../php/userconfig.php';

$macAddress = strtolower($_GET['macaddress']);
$phValue = $_GET['ph'];
$moisturePercentage = $_GET['moisture'];
$waterLevel = $_GET['waterlevel'];

$sql = "INSERT INTO plantiq_realtime_log SET
            mac_address = '$macAddress',
            ph_level = '$phValue',
            soil_moisture = '$moisturePercentage',
            water_level = '$waterLevel'";

if ($conn->query($sql) === TRUE) {
    echo "Record added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>