<?php
require_once('../php/userconfig.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the event from the database
    $deleteQuery = "DELETE FROM schedule_list WHERE id = '$id'";

    if ($conn->query($deleteQuery) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Event deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error deleting event']);
    }
    
} else {
     json_encode(['status' => 'error', 'message' => 'Invalid request method or missing event ID']);
}

$conn->close();
?>
