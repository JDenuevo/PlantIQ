<?php
include 'dbconfig.php';
session_start();

header('Content-Type: application/json');
$response = array();

if(isset($_POST['comment_id'])) {
    $comment_id = mysqli_real_escape_string($conn, $_POST['comment_id']);
    
    $sql = "DELETE FROM tbl_comments WHERE comment_id = '$comment_id'";
    
    if ($conn->query($sql)) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error deleting comment: ' . $conn->error;
    }
    
    echo json_encode($response);
    exit;
} else {
    $response['status'] = 'error';
    $response['message'] = 'Incomplete data for deleting comment';
    echo json_encode($response);
    exit;
}



$conn->close();
echo json_encode($response);
?>
