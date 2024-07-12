<?php
include 'dbconfig.php';
session_start();

$email = isset($_POST['email']) ? trim($_POST['email']) : '';

$response = array();

// Check if email is provided
if ($email === '') {
    $response['status'] = 'error';
    $response['message'] = 'Email parameter is missing';
    echo json_encode($response);
    exit;
}

$sql = "SELECT prof_pic, name, username, email FROM tbl_users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    if ($result->num_rows > 0) {
        // Fetch user data and encode the profile picture
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['prof_pic'])) {
                // If profile picture exists, encode it
                $row['prof_pic'] = base64_encode($row['prof_pic']);
            }
            $response[] = $row;
        }
        $response = [
            'status' => 'success',
            'response' => $response,
        ];
    } else {
        // No user found
        $response = [
            'status' => 'error',
            'message' => 'No user found for the provided email',
        ];
    }
} else {
    // Query execution error
    $response = [
        'status' => 'error',
        'message' => 'Error fetching user: ' . $conn->error,
    ];
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Return the JSON response
echo json_encode($response);
?>
