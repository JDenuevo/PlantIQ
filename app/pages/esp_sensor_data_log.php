<?php
include '../php/userconfig.php';
date_default_timezone_set('Asia/Manila');

$macAddress = strtolower($_GET['macaddress']);
$phValue = $_GET['ph'];
$moisturePercentage = $_GET['moisture'];
$waterLevel = $_GET['waterlevel'];

// Check if a record exists for the given MAC address within the last 60 seconds
$checkSql = "SELECT * FROM esp_data_log 
             WHERE mac_address = '$macAddress' 
             AND timestamp >= NOW() - INTERVAL 180 SECOND";

$checkResult = $conn->query($checkSql);

if ($checkResult->num_rows == 0) {
    // No record found within the last 60 seconds, insert a new record
    $sql = "INSERT INTO esp_data_log SET
                mac_address = '$macAddress',
                ph_level = '$phValue',
                soil_moisture = '$moisturePercentage',
                water_level = '$waterLevel'";

    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Record not added. Data already received within the last 60 seconds for this MAC address.";
}

$conn->close();
?>
