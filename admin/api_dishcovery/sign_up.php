<?php 
include 'dbconfig.php';
session_start();

$response = array();

if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['error'] = "Invalid email format";
    } else {
        $hashed_password = md5($password);
        
        $sql = "SELECT * FROM tbl_users WHERE email = '$email'";
        
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $response['error'] = "Email already exists!";
        } else {
            $insert_sql = "INSERT INTO tbl_users (name, username, email, password) VALUES ('$username', '$username', '$email', '$hashed_password')";
            if ($conn->query($insert_sql) === TRUE) {
                $response['success'] = "User registered successfully";
            } else {
                $response['error'] = "Error: " . $insert_sql . "<br>" . $conn->error;
            }
        }
    }
    
    $conn->close();
} else {
    $response['error'] = "All fields are required.";
}

echo json_encode($response);
?>
