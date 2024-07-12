<?php
session_start();
include 'userconfig.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming $row contains the existing plant information

    // Get the new values from the form
    $PlantID = $_POST['plant_id'];
    $newPlantName = $_POST['plant_name'];
    $newPlantDescription = $_POST['plant_description'];

    // Check if there are changes in plant_name or plant_description
    if ($newPlantName != $row['plant_name'] || $newPlantDescription != $row['plant_description']) {
        // Perform the update in plantiq_recommended table
        // Use prepared statement to prevent SQL injection
        $updateQuery = "UPDATE plantiq_recommended SET plant_name = ?, plant_description = ? WHERE plant_id = ?";

        // Prepare the statement
        $stmt = mysqli_prepare($conn, $updateQuery);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssi", $newPlantName, $newPlantDescription, $PlantID);

        // Execute the update query
        if (mysqli_stmt_execute($stmt)) {
            // Close the statement
            mysqli_stmt_close($stmt);
            header('Location: ../pages/plants.php');
            exit();
        } else {
            echo "Error updating plant information: " . mysqli_error($conn);
            exit(); // Add exit to stop further execution on error
        }
    } else {
        echo "No changes detected in plant_name or plant_description. Plant information remains unchanged.";
    }

   // Check if a new image is uploaded
    $uploadDirectory = '../../app/assets/img/';
    
    if (isset($_FILES['plant_img']) && $_FILES['plant_img']['error'] == UPLOAD_ERR_OK) {
        // Validate and sanitize the uploaded file
        $image_name = basename($_FILES['plant_img']['name']);
        $new_image_path = $uploadDirectory . $image_name;
    
        // Move the uploaded image to the "uploads" folder
        if (move_uploaded_file($_FILES['plant_img']['tmp_name'], $new_image_path)) {
            // Update the product image path in the database
            $sql_image = "UPDATE plantiq_recommended SET plant_img = ? WHERE plant_id = ?";
            $stmt_image = $conn->prepare($sql_image);
    
            // Adjust the image path to match the server directory structure
            $adjusted_image_path = str_replace('../../app/', '../', $new_image_path);
    
            // Bind parameters
            $stmt_image->bind_param("si", $adjusted_image_path, $PlantID);
    
            // Execute the image update query
            $stmt_image->execute();
            $stmt_image->close();
    
            // Redirect after successful image upload
            header('Location: ../pages/plants.php');
            exit();
        } else {
            echo "Error uploading image.";
        }
    }

}
?>

