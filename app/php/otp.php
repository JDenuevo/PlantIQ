<?php
// Get the submitted OTP value
$submittedOTP = $_POST['otp'];

// Get the correct OTP value from the hidden field
$correctOTP = $_POST['correct_otp'];

// Compare the submitted OTP with the correct OTP
if ($submittedOTP !== $correctOTP) {
    // OTPs do not match, display an error message
} else {
    // OTPs match, proceed to newpass.php
    header("Location: ../pages/newpass.php");
}
?>