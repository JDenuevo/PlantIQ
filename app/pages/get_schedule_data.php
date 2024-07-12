<?php
session_start();
// Include your database connection code
require_once('../php/userconfig.php');

// Assuming $macaddress is set or passed to this script
$macaddress = isset($_SESSION['macaddress']) ? $_SESSION['macaddress'] : '';

// Fetch schedule data based on the device MAC address
$schedules = $conn->query("SELECT * FROM `schedule_list` WHERE device_mac = '$macaddress'");
$sched_res = [];

while ($row = $schedules->fetch_assoc()) {
    $event = [
        'id' => $row['id'],
        'title' => $row['title'],
        'description' => $row['description'],
        'start_datetime' => $row['start_datetime'],
        'end_datetime' => $row['end_datetime'],
    ];
    $sched_res[] = $event;
}

// Close the database connection
if (isset($conn)) {
    $conn->close();
}

// Return the schedule data in JSON format
header('Content-Type: application/json');
echo json_encode($sched_res);
?>
