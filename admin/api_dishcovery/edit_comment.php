<?php
include 'dbconfig.php';
session_start();

header('Content-Type: application/json');
$response = array();

if(isset($_POST['action']) && $_POST['action'] === 'edit_comment') {
    if(isset($_POST['comment_id'], $_POST['new_comment'])) {
        $comment_id = mysqli_real_escape_string($conn, $_POST['comment_id']);
        $new_comment = mysqli_real_escape_string($conn, $_POST['new_comment']);
        
        $sql = "UPDATE tbl_comments SET comment_description = '$new_comment' WHERE comment_id = '$comment_id'";
        
        if ($conn->query($sql)) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error updating comment: ' . $conn->error;
        }
        
        echo json_encode($response);
        exit;
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Incomplete data for editing comment';
        echo json_encode($response);
        exit;
    }
}


$conn->close();
echo json_encode($response);
?>
