<?php
include 'dbconfig.php';
session_start();

$email = $_POST['email'];
$response = array();

$sql = "SELECT ewallet_value FROM tbl_users WHERE email = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $response['ewallet_value'] = $row['ewallet_value'];
            $response['status'] = 'success';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'No E-wallet value available';
        }
        
        $result->close();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error executing statement: ' . $stmt->error;
    }
    
    $stmt->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error preparing statement: ' . $conn->error;
}

$conn->close();
echo json_encode($response);
?>
