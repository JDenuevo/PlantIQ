<?php
// Include your database connection code here
include 'userconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["plant_id"])) {
    $plantId = $_GET["plant_id"];

    // Validate and sanitize the input to prevent SQL injection
    $plantId = filter_var($plantId, FILTER_SANITIZE_NUMBER_INT);

    // Your SQL query to delete the plant
    $sql = "DELETE FROM plantiq_plants WHERE id = $plantId";

    if ($conn->query($sql) === TRUE) {
        // Deletion successful
        $response = array("success" => true);
        header('Location: ../pages/adddevice.php?modal=1');
        exit();
    } else {
        // Error in deletion
        $response = array("success" => false, "error" => $conn->error);
    }

    // Output the response as JSON (or any other format you prefer)
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Invalid request
    http_response_code(400); // Bad Request
    echo "Invalid request";
}
?>