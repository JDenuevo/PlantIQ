<?php
include 'dbconfig.php';
session_start();

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : $_SESSION['email'];
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];
    $fullname = $_POST['fullname'];

    // Initialize image data to null
    $imageData = null;

    // Check if a file is uploaded
    if (isset($_FILES["prof_pic"]) && $_FILES["prof_pic"]["error"] === 0) {
        // Read the file content as binary data
        $imageData = file_get_contents($_FILES["prof_pic"]["tmp_name"]);
    }

    if (empty($newUsername) && empty($newPassword) && empty($fullname) && empty($imageData)) {
        $response['success'] = false;
        $response['message'] = "No changes to update!";
    } else {
        $updateSql = "UPDATE tbl_users SET ";
        $params = array();

        // Append updates based on non-empty values
        if (!empty($newUsername)) {
            $updateSql .= "username = ?, ";
            $params[] = $newUsername;
        }

        if (!empty($newPassword)) {
            $hashedPassword = md5($newPassword);
            $updateSql .= "password = ?, ";
            $params[] = $hashedPassword;
        }

        if (!empty($fullname)) {
            $updateSql .= "name = ?, ";
            $params[] = $fullname;
        }

        if ($imageData !== null) {
            $updateSql .= "prof_pic = ?, ";
            $params[] = $imageData;
        }

        // Remove trailing comma and space
        $updateSql = rtrim($updateSql, ', ');

        // Add WHERE clause
        $updateSql .= " WHERE email = ?";
        $params[] = $email;

        $stmt = $conn->prepare($updateSql);
        if ($stmt) {
            // Determine the parameter types for binding
            $types = str_repeat("s", count($params));
            $stmt->bind_param($types, ...$params);

            $result = $stmt->execute();

            if ($result) {
                $response['success'] = true;
                $response['message'] = "User details updated successfully!";
            } else {
                $response['success'] = false;
                $response['message'] = "Failed to update user details!";
            }

            $stmt->close();
        } else {
            $response['success'] = false;
            $response['message'] = "Error preparing statement!";
        }
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request method!";
}

echo json_encode($response);
?>
