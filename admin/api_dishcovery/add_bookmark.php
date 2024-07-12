<?php
include 'dbconfig.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookmark_by = $_SESSION['email'] ?? $_POST['email'];
    $recipe_id = $_POST['recipe_id'];

    $sql = "INSERT INTO tbl_bookmarks (bookmark_by, recipe_id)
            VALUES ('$bookmark_by', '$recipe_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Bookmark added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>