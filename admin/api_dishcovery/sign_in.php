<?php 
include 'dbconfig.php';
session_start();

$response = array();

if(isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = md5($_POST['password']);
    
    $sql = "SELECT * FROM tbl_users WHERE username = '$username'";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashed_password = $user['password'];
        if ($password == $hashed_password) {
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $response['success'] = "You have successfully logged in!";
            $response['redirect'] = "pages/dashboard.php";
            // Include name and email in the response
            $response['name'] = $_SESSION['name'];
            $response['email'] = $_SESSION['email'];
        } else {
            $response['error'] = "Invalid Credentials";
        }
    } else {
        $response['error'] = "Invalid Credentials";
    }
    $conn->close();
} else {
    $response['error'] = "Both fields are required.";
}

echo json_encode($response);
?>
<?php 
include 'dbconfig.php';
session_start();

$response = array();

if(isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = md5($_POST['password']);
    
    $sql = "SELECT * FROM tbl_users WHERE username = '$username'";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashed_password = $user['password'];
        if ($password == $hashed_password) {
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $response['success'] = "You have successfully logged in!";
            $response['redirect'] = "pages/dashboard.php";
            // Include name and email in the response
            $response['name'] = $_SESSION['name'];
            $response['email'] = $_SESSION['email'];
        } else {
            $response['error'] = "Invalid Credentials";
        }
    } else {
        $response['error'] = "Invalid Credentials";
    }
    $conn->close();
} else {
    $response['error'] = "Both fields are required.";
}

echo json_encode($response);
?>
<?php 
include 'dbconfig.php';
session_start();

$response = array();

if(isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = md5($_POST['password']);
    
    $sql = "SELECT * FROM tbl_users WHERE username = '$username'";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashed_password = $user['password'];
        if ($password == $hashed_password) {
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $response['success'] = "You have successfully logged in!";
            $response['redirect'] = "pages/dashboard.php";
            // Include name and email in the response
            $response['name'] = $_SESSION['name'];
            $response['email'] = $_SESSION['email'];
        } else {
            $response['error'] = "Invalid Credentials";
        }
    } else {
        $response['error'] = "Invalid Credentials";
    }
    $conn->close();
} else {
    $response['error'] = "Both fields are required.";
}

echo json_encode($response);
?>
