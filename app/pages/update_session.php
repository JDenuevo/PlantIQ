<?php
session_start();

// Check if the selected MAC address is set in the POST data
if (isset($_POST['macaddressDropdown'])) {
    // Store the selected MAC address in the session
    $_SESSION['macaddress'] = $_POST['macaddressDropdown'];
    
    // Optionally, you can send a response back to the JavaScript indicating success
    echo 'Session updated successfully.';
} else {
    // If the selected MAC address is not set in the POST data, send an error response
    echo 'Error: MAC address not provided.';
}
?>
