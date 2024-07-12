<?php
session_start();
// Include the connection file
include '../php/userconfig.php';

// Check if the form is submitted
if (isset($_POST['savechanges'])) {
    // Retrieve data from the form
    $macaddress = $_POST['device_mac'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_datetime = $_POST['start_datetime'];
    $end_datetime = $_POST['end_datetime'];

    // Prepare and execute the SQL query
    $sql = "INSERT INTO schedule_list (device_mac, title, description, start_datetime, end_datetime) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $macaddress, $title, $description, $start_datetime, $end_datetime);


    if ($stmt->execute()) {
        // Data inserted successfully
        $_SESSION['success_message'] = 'Schedule saved successfully!';
    } else {
        // Error in executing the query
        $_SESSION['error_message'] = 'Error: ' . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    $conn->close();
    
    // Redirect using JavaScript to ensure proper execution after AJAX call
    echo "<script>window.location.href = 'calendar.php';</script>";
    exit();
} else {
    // Redirect if the form is not submitted
    header("Location: calendar.php"); // Change to your desired location
    exit();
}
?>
