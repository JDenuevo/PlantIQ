<?php
include 'dbconfig.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['recipe_id'])) {
        http_response_code(400);
        echo json_encode(["error" => "Missing parameters"]);
        exit;
    }

    $email = $conn->real_escape_string($_SESSION['email'] ?? $_POST['email']);
    $recipeId = intval($_POST['recipe_id']);

    // Prepare and execute SQL query using prepared statement
    $stmt = $conn->prepare("SELECT * FROM tbl_bookmarks WHERE bookmark_by = ? AND recipe_id = ?");
    $stmt->bind_param("si", $email, $recipeId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["isBookmarked" => true]);
    } else {
        echo json_encode(["isBookmarked" => false]); 
    }
    
    $stmt->close();
}

$conn->close();
?>