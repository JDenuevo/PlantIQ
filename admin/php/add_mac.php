<?php
session_start();
include 'userconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a function to sanitize and validate input
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Get the MAC addresses from the form
    $macAddressesInput = $_POST["mac_addresses"];

    // Sanitize and validate the input
    $macAddresses = sanitizeInput($macAddressesInput);

    // Explode the input into an array using space as the separator
    $macAddressesArray = explode(" ", $macAddresses);


    // Prepare and execute the SQL statement for each MAC address
    foreach ($macAddressesArray as $macAddress) {
        // Check if the MAC address is not empty
        if (!empty($macAddress)) {
            // Assuming your table has columns 'id' and 'mac_address'
            $sql = "INSERT INTO plantiq_availablemacaddresses (macaddress) VALUES ('$macAddress')";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    // Close the database connection
    $conn->close();

    // Redirect the user or perform other actions after processing
    header("Location: /pages/mac.php");
    exit();
}
?>