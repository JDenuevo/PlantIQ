<?php
include 'dbconfig.php';
session_start();

header('Content-Type: application/json');
$response = array();

// Check if recipe_id is provided
if(isset($_GET['recipe_id'])) {
    // Sanitize input
    $recipe_id = mysqli_real_escape_string($conn, $_GET['recipe_id']);

    // Prepare SQL query
    $sql = "SELECT c.comment_id, c.comment_by, c.recipe_id, c.comment_description, c.date_created, u.prof_pic, u.name
            FROM tbl_comments c
            INNER JOIN tbl_users u ON c.comment_by = u.email
            WHERE c.recipe_id = '$recipe_id'
            ORDER BY c.date_created ASC";

    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Convert prof_pic blob to base64
                $row['prof_pic'] = base64_encode($row['prof_pic']);
                $response['comments'][] = $row;
            }
            $result->close();
            $response['status'] = 'success';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'No comments found for this recipe';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error fetching comments: ' . $conn->error;
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Recipe ID not provided';
}

$conn->close();
echo json_encode($response);
?>
