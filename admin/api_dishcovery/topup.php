<?php

include 'dbconfig.php';
session_start();

if (isset($_POST['payment']) && isset($_POST['transaction_id'])) {
    $ewallet_value = $_POST['payment'];
    $transaction_id = $_POST['transaction_id'];
    $email = isset($_POST['email']) ? $_POST['email'] : $_SESSION['email'];

    $update_sql = "UPDATE tbl_users SET ewallet_value = ewallet_value + ? WHERE email = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ds", $ewallet_value, $email);

    if ($update_stmt->execute()) {
        $amount_string = "+" . $ewallet_value;
        
        $sent_from = "TOP-UP";
        $sent_to = $email;

        $insert_sql = "INSERT INTO tbl_history_of_donations (transaction_id, amount, sent_by, sent_to)
                       VALUES (?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ssss", $transaction_id, $amount_string, $sent_from, $sent_to);

        if ($insert_stmt->execute()) {
            echo json_encode(array("message" => "Top-up successfully!"));
        } else {
            http_response_code(500);
            echo json_encode(array("error" => "Error recording transaction"));
        }
    } else {
        http_response_code(500);
        echo json_encode(array("error" => "Error updating payment value"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("error" => "Invalid request"));
}

?>
