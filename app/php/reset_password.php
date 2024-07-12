<?php
session_start();
include 'userconfig.php';
// Get the submitted OTP value
$password = $_POST['password'];
$email = $_POST['email'];
$hashing1 = hash("SHA1", $password);
// OTPs match, proceed to newpass.php
$hash_password = md5($hashing1);

$sql = "UPDATE plantiq_login SET password = '$hash_password' WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
header('Location: ../index.php');

// if (!empty($errors)) {
//     // Redirect back to the login page with the error messages
//     $errorString = implode(',', $errors);
//     header('Location: ../newpass.php?errors=' . urlencode($errorString));
//     exit();
// }
?>