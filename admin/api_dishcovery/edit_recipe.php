<?php
include 'dbconfig.php';
session_start();
date_default_timezone_set('Asia/Manila');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipe_id = $_POST['recipe_id']; 

    $recipe_name = trim($_POST['recipe_name']);
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $date_updated = date("Y-m-d H:i:s");
    $image_query = "";

    // Check if a new image file is uploaded
    if (!empty($_FILES['image']['tmp_name']) && file_exists($_FILES['image']['tmp_name'])) {
        $image = file_get_contents($_FILES['image']['tmp_name']);
        $image = base64_encode($image);
        $image_query = ", image = '$image'";
    }

    // Construct the SQL query
    $sql = "UPDATE tbl_recipes 
            SET recipe_name = '$recipe_name', 
                ingredients = '$ingredients', 
                instructions = '$instructions' 
                $image_query,
                date_updated = '$date_updated'
            WHERE recipe_id = $recipe_id";

    if ($conn->query($sql) === TRUE) {
        echo "Recipe updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
