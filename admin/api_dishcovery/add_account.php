<?php 
include 'dbconfig.php';
session_start();

$response = array();

if (!empty($_POST['username']) && !empty($_POST['email'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    
    // Check if the user already exists
    $sql = "SELECT * FROM tbl_users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // User already exists, do nothing or handle accordingly
        $response['success'] = "User already exists";
    } else {
        // Insert the user into the database
        $insert_sql = "INSERT INTO tbl_users (name, username, email, password) VALUES ('$username', '$username', '$email', '')";
        if ($conn->query($insert_sql) === TRUE) {
            // User inserted successfully, log the user in
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $response['success'] = "User registered and logged in successfully";
        } else {
            $response['error'] = "Error inserting user: " . $conn->error;
        }
    }
} else {
    $response['error'] = "All fields are required.";
}

$conn->close();

echo json_encode($response);
?>
