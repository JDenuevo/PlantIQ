<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include 'userconfig.php';

$usernameVal = $_POST["username"];
$passwordVal = $_POST["password"];

$cookie_time = 60 * 60 * 24 * 30; // 30 days

if (isset($_POST['remember'])) {
    $escapedRemember = mysqli_real_escape_string($conn, $_POST['remember']);
    $cookie_time_Onset = time() + $cookie_time; // Calculate the expiration time

    if (isset($escapedRemember)) {
        /*
         * Set Cookie from here for one month
         * Hash the username and password using md5() before setting the cookie
         * */
        setcookie("fnbkn", $usernameVal, $cookie_time_Onset, '/'); // Set cookie with correct expiration time
        setcookie("qbtuyqug", $passwordVal, $cookie_time_Onset, '/'); // Set cookie with correct expiration time

        $_SESSION['fnbkn'] = $usernameVal;
        $_SESSION['qbtuyqug'] = $passwordVal;
    }
} else {
    $cookie_time_fromOffset = time() - $cookie_time; // Calculate the expiration time
    setcookie("fnbkn", '', $cookie_time_fromOffset, '/'); // Unset cookie with correct expiration time
    setcookie("qbtuyqug", '', $cookie_time_fromOffset, '/'); // Unset cookie with correct expiration time

    $_SESSION['fnbkn'] = '';
    $_SESSION['qbtuyqug'] = '';
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
		$uname = validate($_POST['username']);
        $pass = validate($_POST['password']);
        // hashing the password
        $pass1 = hash("SHA1", $pass);
        $pass2 = md5($pass1);

    $sql = "SELECT * FROM plantiq_login WHERE username='$uname' AND type = 1";
    if ($rs = $conn->query($sql)) {
        if ($rs->num_rows > 0) {
            $row = $rs->fetch_assoc();
            $user_name = $row['username'];
            $id = $row['id'];

            // authenticate the user
            if ($row['password'] === $pass2) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['status'] = "Logged In";
                header("Location: ../pages/home.php");
                exit();
            } else {
                
                $errors[] = "Invalid Credentials! " . $pass2;
               
            }
        } else {
            $errors[] = "Username not found. Please try again!";
        }
    } else {
        $errors[] = "Something went wrong. Please try again later.";
    }

    // check for error
    if (!empty($errors)) {
        // Redirect back to the login page with the error messages
        $errorString = implode(',', $errors);
        header('Location: ../index.php?errors=' . urlencode($errorString));
        exit();
    }
} else {
    // if the username or password is not set, redirect back to the login page
    header('Location: ../index.php');
    exit();
}
?>