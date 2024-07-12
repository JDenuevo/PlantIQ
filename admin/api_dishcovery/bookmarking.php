<?php
include 'dbconfig.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookmark_by = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : $_SESSION['email'];
    $recipe_id = intval($_POST['recipe_id']);

    // Check if the bookmark exists
    $stmt = $conn->prepare("SELECT * FROM tbl_bookmarks WHERE bookmark_by = ? AND recipe_id = ?");
    $stmt->bind_param("si", $bookmark_by, $recipe_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Bookmark exists, so remove it
        $sql = "DELETE FROM tbl_bookmarks WHERE bookmark_by = '$bookmark_by' AND recipe_id = '$recipe_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Bookmark removed successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Bookmark doesn't exist, so add it
        $sql = "INSERT INTO tbl_bookmarks (bookmark_by, recipe_id) VALUES ('$bookmark_by', '$recipe_id')";
        if ($conn->query($sql) === TRUE) {
            echo "Bookmark added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $stmt->close();
}

$conn->close();
?>