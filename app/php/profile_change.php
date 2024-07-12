<?php
session_start();
include 'userconfig.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming form fields are posted with the names "email", "newUser", "newPassword"
    $email = $_POST["email"];
    $newUsername = trim($_POST["newUser"]);
    $newFullname = trim($_POST["newName"]);
    $newPassword = $_POST["newPassword"];

    // Check if the "changeUsername" submit button is set
    if (isset($_POST["changeUsername"])) {
        // Validate and update username
        if (!empty($newUsername)) {
            // Use prepared statements to prevent SQL injection
            $updateUsernameSql = "UPDATE plantiq_login SET username = ? WHERE email = ?";
            $updateUsernameStmt = $conn->prepare($updateUsernameSql);
            $updateUsernameStmt->bind_param("ss", $newUsername, $email);
            $updateUsernameResult = $updateUsernameStmt->execute();

            if ($updateUsernameResult) {
                // Username updated successfully
                $_SESSION['username'] = $newUsername; // Update session variable if needed
            } else {
                // Handle the error
                echo "Error updating username: " . $updateUsernameStmt->error;
            }

            $updateUsernameStmt->close();
        }
    }

    // Check if the "changePassword" submit button is set
    if (isset($_POST["changePassword"])) {
        // Validate and update password
        if (!empty($newPassword)) {
            // Use MD5 for password hashing (not recommended for security reasons)
            $hashing1 = hash("SHA1", $newPassword);
            $hashedPassword = md5($hashing1);
            $updatePasswordSql = "UPDATE plantiq_login SET password = ? WHERE email = ?";
            $updatePasswordStmt = $conn->prepare($updatePasswordSql);
            $updatePasswordStmt->bind_param("ss", $hashedPassword, $email);
            $updatePasswordResult = $updatePasswordStmt->execute();

            if (!$updatePasswordResult) {
                // Handle the error
                echo "Error updating password: " . $updatePasswordStmt->error;
            }

            $updatePasswordStmt->close();
        }
    }
    
    // Check if the "changeFullname" submit button is set
    if (isset($_POST["changeFullname"])) {
        // Validate and update Fullname
        if (!empty($newFullname)) {
            // Use prepared statements to prevent SQL injection
            $updateFullnameSql = "UPDATE plantiq_login SET fullname = ? WHERE email = ?";
            $updateFullnameStmt = $conn->prepare($updateFullnameSql);
            $updateFullnameStmt->bind_param("ss", $newFullname, $email);
            $updateFullnameResult = $updateFullnameStmt->execute();

            if ($updateFullnameResult) {
                // Fullname updated successfully
                $_SESSION['fullname'] = $newFullname; // Update session variable if needed
            } else {
                // Handle the error
                echo "Error updating fullname: " . $updateFullnameStmt->error;
            }

            $updateFullnameStmt->close();
        }
    }
    
    // Redirect to settings page after updating
    header('Location: ../pages/settings.php');
    exit();
}

// Close the database connection
$conn->close();
?>
