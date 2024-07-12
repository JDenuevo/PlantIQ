<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start();
include 'userconfig.php';

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';

$email = trim($_POST['email']);

$query = "SELECT * FROM plantiq_login WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // Generate a random OTP
    $otp = mt_rand(100000, 999999);
    
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true); // Passing `true` enables exceptions

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'mail.plantiq.info'; // Replace with your hosting provider's SMTP server
        $mail->Password   = 'EV5AFEvqiiKe'; // Replace with your SMTP password
        $mail->SMTPAuth   = true;
        $mail->Username   = 'no-reply@plantiq.info'; // Replace with your SMTP username
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('no-reply@plantiq.info', 'Plant IQ'); // Replace with your email and name
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset OTP';
        $mail->Body    = 'Your OTP for password reset is: ' . $otp;

        // Send email
        $mail->send();

        // Store the OTP in the session for validation on the OTP page
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        header('Location: ../pages/otp.php');
        exit();
    } catch (Exception $e) {
        $errors[] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // Email does not exist, display SweetAlert or handle errors as needed
    $errors[] = "No email found in our database!";
}

// Check for errors
if (!empty($errors)) {
    // Redirect back to the login page with the error messages
    $errorString = implode(',', $errors);
    header('Location: ../pages/forgotpass.php?errors=' . urlencode($errorString));
    // echo 'Errors occurred: ' . implode(', ', $errors);
    exit();
}
?>
