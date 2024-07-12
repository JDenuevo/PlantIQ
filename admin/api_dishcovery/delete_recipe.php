<?php
include 'dbconfig.php';
session_start();
date_default_timezone_set('Asia/Manila');

if(isset($_POST['recipeId'])) {
    $recipeId = $_POST['recipeId'];

    $sql = "DELETE FROM tbl_recipes WHERE recipe_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $recipeId);

    if ($stmt->execute()) {
        $response = array('status' => 'success', 'message' => 'Recipe deleted successfully');
        echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to delete recipe');
        echo json_encode($response);
    }
    $stmt->close();
    $conn->close();
} else {
    $response = array('status' => 'error', 'message' => 'Recipe ID not provided');
    echo json_encode($response);
}
?>
