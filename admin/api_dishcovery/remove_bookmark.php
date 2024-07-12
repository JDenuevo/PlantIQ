<?php
include 'dbconfig.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookmark_by = $_SESSION['email'] ?? $_POST['email'];
    $recipe_id = $_POST['recipe_id'];

    $sql = "DELETE FROM tbl_bookmarks
            WHERE bookmark_by = '$bookmark_by' AND recipe_id = '$recipe_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Bookmark removed successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>