<?php
include 'dbconfig.php';
session_start();
date_default_timezone_set('Asia/Manila');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipe_name = trim($_POST['recipe_name']);
    $category = $_POST['category_name'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $posted_by = isset($_POST['email']) ? $_POST['email'] : $_SESSION['email'];
    $isPublic = 1;
    $date_updated = date("Y-m-d H:i:s");

    if (!empty($_FILES['image']['tmp_name']) && file_exists($_FILES['image']['tmp_name'])) {
        $image = file_get_contents($_FILES['image']['tmp_name']);
        $image = base64_encode($image);
    } else {
        $image = null;
    }

    $sql = "INSERT INTO tbl_recipes (recipe_name, posted_by, category, ingredients, instructions, image, isPublic, date_updated)
            VALUES ('$recipe_name', '$posted_by', '$category', '$ingredients', '$instructions', '$image', '$isPublic', '$date_updated')";

    if ($conn->query($sql) === TRUE) {
        echo "Recipe added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>