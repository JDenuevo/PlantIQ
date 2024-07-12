<?php
session_start();
include 'userconfig.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the new values from the form
    $PlantID = $_POST['plant_id'];
    $newPlantName = $_POST['plant_name'];
    $newPlantDescription = $_POST['plant_description'];

    // Check if a new image is uploaded
    $uploadDirectory = '../../app/assets/img/';
    $new_image_path = null;

    if (isset($_FILES['plant_img']) && $_FILES['plant_img']['error'] == UPLOAD_ERR_OK) {
        // Validate and sanitize the uploaded file
        $image_name = basename($_FILES['plant_img']['name']);
        $new_image_path = $uploadDirectory . $image_name;

        // Move the uploaded image to the "uploads" folder
        if (move_uploaded_file($_FILES['plant_img']['tmp_name'], $new_image_path)) {
            // Adjust the image path to match the server directory structure
            $adjusted_image_path = str_replace('../../app/', '../', $new_image_path);
        } else {
            echo "Error uploading image.";
            exit();
        }
    }

    // Use prepared statement to prevent SQL injection
    $insertQuery = "INSERT INTO plantiq_recommended (plant_id, plant_name, plant_description, plant_img) VALUES (?, ?, ?, ?)";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $insertQuery);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "isss", $PlantID, $newPlantName, $newPlantDescription, $adjusted_image_path);

    // Execute the insert query
    if (mysqli_stmt_execute($stmt)) {
        // Close the statement
        mysqli_stmt_close($stmt);

        // Redirect after successful insert
        header('Location: ../pages/plants.php');
        exit();
    } else {
        echo "Error inserting plant information: " . mysqli_error($conn);
        exit(); // Add exit to stop further execution on error
    }
}
?>
