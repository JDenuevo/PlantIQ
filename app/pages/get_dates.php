<?php
// Include your database connection code here
include '../php/userconfig.php';

// Check if device and email are set in the POST data
if(isset($_POST['device']) && isset($_POST['email'])) {
    // Sanitize input to prevent SQL injection
    $device = mysqli_real_escape_string($conn, $_POST['device']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Query to retrieve dates associated with the selected device
    $sql = "SELECT DISTINCT date_planted, expected_harvest FROM plantiq_plants WHERE email = '$email' AND mac_address = '$device'";
    $result = mysqli_query($conn, $sql);

    // Construct HTML options for date select
    $options = '<option value="" selected>Choose Date Range</option>'; // Empty option added
    while ($row = mysqli_fetch_assoc($result)) {
        $date_planted = $row['date_planted'];
        $expected_harvest = $row['expected_harvest'];
        $formatted_date_planted = date('F j, Y', strtotime($date_planted));
        $formatted_expected_harvest = date('F j, Y', strtotime($expected_harvest));
        $date_range = "$formatted_date_planted - $formatted_expected_harvest";
        $options .= "<option value=\"$date_planted\">$date_range</option>";
    }

    // Return HTML options
    echo $options;
} else {
    // Handle case where device or email is not set in POST data
    echo "<option value='' disabled selected>No History</option>";
}
?>
