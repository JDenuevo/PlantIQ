<?php
include 'userconfig.php';

$email = $_POST['email'];
$mac_address = $_POST['mac_address'];
$deviceName = $_POST['device_name'];
$date_planted = $_POST['date_planted'];

// Calculate the expected harvest date (3 weeks from the provided date_planted)
$expected_harvest = date('Y-m-d', strtotime($date_planted . '+3 weeks'));

// SQL query to update data in plantiq_binding
$sqlBinding = "UPDATE plantiq_binding SET device_name = ? WHERE email = ? AND macaddress = ?";

// Prepare the statement for plantiq_binding
$stmtBinding = $conn->prepare($sqlBinding);

// Check for errors in preparing the statement
if (!$stmtBinding) {
    echo "Error: " . $conn->error;
} else {
    // Bind parameters for plantiq_binding
    $stmtBinding->bind_param('sss', $deviceName, $email, $mac_address);

    // Execute the statement for plantiq_binding
    $stmtBinding->execute();

    // Check for errors
    if ($stmtBinding->error) {
        echo "Error: " . $stmtBinding->error;
    }

    // Close the statement for plantiq_binding
    $stmtBinding->close();
}

// SQL query to update data in plantiq_plants
$sqlPlants = "UPDATE plantiq_plants SET date_planted = ?, expected_harvest = ? WHERE email = ? AND mac_address = ?";

// Prepare the statement for plantiq_plants
$stmtPlants = $conn->prepare($sqlPlants);

// Check for errors in preparing the statement
if (!$stmtPlants) {
    echo "Error: " . $conn->error;
} else {
    // Bind parameters for plantiq_plants
    $stmtPlants->bind_param('ssss', $date_planted, $expected_harvest, $email, $mac_address);

    // Execute the statement for plantiq_plants
    $stmtPlants->execute();

    // Check for errors
    if ($stmtPlants->error) {
        echo "Error: " . $stmtPlants->error;
    }

    // Close the statement for plantiq_plants
    $stmtPlants->close();
}

// Close the connection
$conn->close();

// Redirect to the specified page
header("Location: ../pages/adddevice.php");
exit();
?>