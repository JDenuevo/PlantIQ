<?php
include 'dbconfig.php';
session_start();

header('Content-Type: application/json');
$response = array();

$sql = "SELECT * FROM tbl_categories";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $response[] = $row;
        }
        $result->close();
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'No categories found';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error fetching categories: ' . $conn->error;
}

$conn->close();
echo json_encode($response);
?>
