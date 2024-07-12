<?php
// Include your database connection code here
include 'userconfig.php';

date_default_timezone_set('UTC');
$manilaTimeZone = new DateTimeZone('Asia/Manila');

$currentDateTimeManila = new DateTime('now', $manilaTimeZone);

$date = $currentDateTimeManila->format('Y-m-d H:i:s');
// Retrieve values from the URL parameters
$email = $_GET['email'] ?? '';
$macaddress = $_GET['macaddress'] ?? '';
$expected_harvest = $_GET['expected_harvest'] ?? '';

// Check if all required parameters are provided
if (empty($email) || empty($macaddress) || empty($expected_harvest)) {
    // Handle the case where one or more parameters are missing
    die('Missing required parameters');
}

// Sanitize input to prevent SQL injection (you may need more advanced sanitation)
$email = mysqli_real_escape_string($conn, $email);
$macaddress = mysqli_real_escape_string($conn, $macaddress);
$expected_harvest = mysqli_real_escape_string($conn, $expected_harvest);

// Update SQL query
$update_sql = "UPDATE plantiq_plants SET isHarvested = '1', harvested_date = '$date' WHERE email = '$email' AND mac_address = '$macaddress' AND expected_harvest = '$expected_harvest'";

// Execute the update query
$result = mysqli_query($conn, $update_sql);

// Check for errors
if (!$result) {
    // Handle the case where the query execution failed
    die('Error updating database: ' . mysqli_error($your_db_connection));
}

header("Location: ../pages/home.php");
exit();

// Close the database connection (assuming $your_db_connection is the connection object)
mysqli_close($your_db_connection);
?>