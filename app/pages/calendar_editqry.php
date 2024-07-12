<?php
require_once('../php/userconfig.php');

header('Content-Type: application/json'); // Set the content type to JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['edit-id'];
    $title = $_POST['edit-title'];
    $description = $_POST['edit-description'];
    $start_datetime = $_POST['edit-start'];
    $end_datetime = $_POST['edit-end'];

    // Validate and sanitize input data as needed

    // Update the event in the database
    $updateQuery = "UPDATE schedule_list SET title = '$title', description = '$description', start_datetime = '$start_datetime', end_datetime = '$end_datetime' WHERE id = '$id'";
    
    if ($conn->query($updateQuery) === TRUE) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating event']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();
?>
