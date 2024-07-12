<?php
include("../php/userconfig.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
    $id = $_POST['id'];
    $newUsername = $_POST['username'];
    $hashedpassword = ($_POST['password'] !== '') ? hash("SHA1", $_POST['password']) : null; // Hash the password only if it's not empty
    $newPassword = ($hashedpassword !== '') ? md5($hashedpassword) : null;

    // Retrieve existing data from the database
    $sqlSelect = "SELECT username, password FROM plantiq_login WHERE id = '$id'";
    $result = $conn->query($sqlSelect);

    if ($result) {
        // Check if there is at least one row in the result set
        if ($result->num_rows > 0) {
            // Fetch the existing data
            $row = $result->fetch_assoc();
            $existingUsername = $row['username'];
            $existingPassword = $row['password'];

            // Check if there are changes
            $updateUsername = ($newUsername != $existingUsername);
            $updatePassword = ($newPassword !== null && $newPassword != $existingPassword);

            // Build and execute the update query
            if ($updateUsername || $updatePassword) {
                $updateQuery = "UPDATE plantiq_login SET ";
                $updateQuery .= ($updateUsername) ? "username = '$newUsername'" : "";
                $updateQuery .= ($updateUsername && $updatePassword) ? ", " : "";
                $updateQuery .= ($updatePassword) ? "password = '$newPassword'" : "";
                $updateQuery .= " WHERE id = '$id'";

                if ($conn->query($updateQuery)) {
                    // Redirect to home.php upon successful update
                    header("Location: /pages/home.php");
                    exit();
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "No changes to update.";
            }
        } else {
            echo "No record found for the given ID.";
        }

        // Free the result set
        $result->free();
    } else {
        // Handle query error
        echo "Error in query: " . $conn->error;
    }
}

// Close the database connection (if needed)
// $conn->close();
?>
