<?php
// update_status.php

include 'userconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plantId = $_POST['plant_id'];
    $plantStatus = $_POST['plant_status'];

    $updateQuery = "UPDATE plantiq_plants SET plant_status = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);

    if ($stmt) {
        $stmt->bind_param('si', $plantStatus, $plantId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Return the updated status
            echo $plantStatus;
        } else {
            echo "No rows were updated.";
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
