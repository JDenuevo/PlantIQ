<?php
include 'dbconfig.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_who_joined = $_SESSION['email'] ?? $_POST['email'];
    $group_name = $_POST['group_name'];

    $check_sql = "SELECT * FROM tbl_communities WHERE community_name = '$group_name' AND user_who_joined = '$user_who_joined'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $delete_sql = "DELETE FROM tbl_communities WHERE community_name = '$group_name' AND user_who_joined = '$user_who_joined'";

        if ($conn->query($delete_sql) === TRUE) {
            echo "Left group successfully.";
        } else {
            echo "Error: " . $delete_sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: User is not part of the specified group.";
    }
}

$conn->close();
?>
