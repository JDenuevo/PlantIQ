<?php
include 'dbconfig.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_who_joined = $_SESSION['email'] ?? $_POST['email'];
    $group_name = $_POST['group_name'];

    $check_sql = "SELECT * FROM tbl_communities WHERE community_name = '$group_name'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        echo "Error: Community name already exists.";
    } else {
        $insert_sql = "INSERT INTO tbl_communities (community_name, user_who_joined)
                       VALUES ('$group_name', '$user_who_joined')";
        
        if ($conn->query($insert_sql) === TRUE) {
            echo "Group created successfully.";
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
