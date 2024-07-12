<?php
include 'dbconfig.php';
session_start();

header('Content-Type: application/json');
$response = array();

// Fetch the community name from the URL parameter
$community = $_GET['community']; // Assuming 'community' is the parameter name in the URL

// Prepare the SQL query with a condition to filter by community
$sql = "SELECT tbl_recipes.*, tbl_users.name AS posted_by_name, tbl_users.prof_pic AS posted_by_image
        FROM tbl_recipes
        INNER JOIN tbl_users ON tbl_recipes.posted_by = tbl_users.email
        WHERE tbl_recipes.isPublic = 0 AND tbl_recipes.posted_in = '$community'";

$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $binaryImageData = $row['posted_by_image'];
            $base64Image = base64_encode($binaryImageData);
            
            // Store the Base64 image data in the row array
            $row['posted_by_image'] = $base64Image;

            $ingredients = json_decode($row['ingredients'], true);

            $formattedIngredients = array();
            foreach ($ingredients as $ingredient) {
                $formattedIngredients[] = $ingredient['qty'] . 'pcs ' . $ingredient['title'];
            }
            $response['recipes'][] = array(
                'recipe_data' => $row,
                'formatted_ingredients' => $formattedIngredients,
                'image_data' => $base64Image
            );
        }
        $result->close();
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'No Recipes found';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error fetching recipes: ' . $conn->error;
}

$conn->close();

echo json_encode($response);
?>
