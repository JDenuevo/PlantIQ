<?php
session_start();
include 'userconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['mac_address'])) {
        $macAddress = $_POST['mac_address'];
        // Validate $macAddress if needed

        // Assuming you have an ID associated with the MAC address, replace 'your_id_column' with the actual column name
        $id = $_POST['id'];

        // Update the MAC address in the database
        $updateSql = "UPDATE plantiq_availablemacaddresses SET macaddress = '$macAddress' WHERE id = $id";

        if ($conn->query($updateSql) === TRUE) {
            echo "MAC Address updated successfully";
        } else {
            echo "Error updating MAC Address: " . $conn->error;
        }
    } else {
        echo "MAC Address not provided in the form.";
    }
} else {
    echo "Invalid request method.";
}

// Redirect back to the page with the modal, adjust the URL accordingly
header("Location: /pages/mac.php");
exit();
?>