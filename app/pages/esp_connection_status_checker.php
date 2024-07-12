<?php
session_start();
include '../php/userconfig.php';

// Set the timezone to Manila (UTC+8)
date_default_timezone_set('Asia/Manila');

// Get the current time in the desired format (yy-mm-dd hour-minute-second)
$currenttime = date('y-m-d H-i-s');

// Update records where the timestamp is older than 1 minute from the current time
$sqlUpdate = "UPDATE plantiq_espconnection SET status = 'Disconnected' WHERE TIMESTAMPDIFF(SECOND, timestamp, '$currenttime') > 60";
if ($conn->query($sqlUpdate) === TRUE) {
    $affectedRows = $conn->affected_rows;
    echo "$affectedRows records updated as disconnected.";
} else {
    echo "Error updating status: " . $conn->error;
}

$conn->close();
?>
