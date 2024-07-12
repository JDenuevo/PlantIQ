<?php

include 'dbconfig.php';
session_start();

if (isset($_POST['payment'], $_POST['posted_by'], $_POST['transaction_id'])) {
    $amount = $_POST['payment'];
    $email = isset($_POST['email']) ? $_POST['email'] : $_SESSION['email'];
    $sent_to = $_POST['posted_by'];
    $transaction_id = $_POST['transaction_id'];

    $amount = mysqli_real_escape_string($conn, $amount);
    $email = mysqli_real_escape_string($conn, $email);
    $sent_to = mysqli_real_escape_string($conn, $sent_to);
    $transaction_id = mysqli_real_escape_string($conn, $transaction_id);

    $deduct_sql = "UPDATE tbl_users SET ewallet_value = ewallet_value - $amount WHERE email = '$email'";
    $deduct_result = mysqli_query($conn, $deduct_sql);

    if ($deduct_result) {
        $add_sql = "UPDATE tbl_users SET ewallet_value = ewallet_value + $amount WHERE email = '$sent_to'";
        $add_result = mysqli_query($conn, $add_sql);
        
        if ($add_result) {
            // Insert negative amount for the sender
            $record_sql_sender = "INSERT INTO tbl_history_of_donations (transaction_id, amount, sent_by, sent_to) 
                                  VALUES ('$transaction_id', '+$amount', '$email', '$sent_to')";
            $record_result_sender = mysqli_query($conn, $record_sql_sender);
            
            // Insert positive amount for the recipient
            $record_sql_recipient = "INSERT INTO tbl_history_of_donations (transaction_id, amount, sent_by, sent_to) 
                                     VALUES ('$transaction_id', '-$amount', '$email', '$sent_to')";
            $record_result_recipient = mysqli_query($conn, $record_sql_recipient);

            if ($record_result_sender && $record_result_recipient) {
                echo json_encode(['success' => true, 'message' => 'Donation successful']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to record donation transaction']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add donation amount to recipient\'s e-wallet']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to deduct donation amount from your e-wallet']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Missing parameters']);
}

?>
