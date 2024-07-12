<?php
include 'dbconfig.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment_by = isset($_POST['email']) ? $_POST['email'] : $_SESSION['email'];
    $recipe_id = $_POST['recipe_id'];
    $comment_description = $_POST['comment_description'];

    $sql = "INSERT INTO tbl_comments (comment_by, recipe_id, comment_description)
            VALUES ('$comment_by', '$recipe_id', '$comment_description')";

    if ($conn->query($sql) === TRUE) {
        echo "Comment added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>  