<?php
include 'dbconfig.php';
session_start();

// Retrieve email from POST request
$email = $_POST['email'];

// Initialize response array
$response = array();

$topup = "TOP-UP";

$sql = "SELECT *, CONCAT(amount, ' $') AS amount_php 
        FROM tbl_history_of_donations 
        WHERE (sent_by = ? AND sent_to = ?) 
              OR (sent_by = ? AND LEFT(amount, 1) = '-') 
              OR (sent_to = ? AND LEFT(amount, 1) = '+') 
        ORDER BY date_sent DESC";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind parameters to the SQL statement
    $stmt->bind_param("ssss", $topup, $email, $email, $email);

    // Execute the statement
    $stmt->execute();

    // Retrieve the result set
    $result = $stmt->get_result();

    // Check if there are results
    if ($result) {
        if ($result->num_rows > 0) {
            // Process each result
            while ($row = $result->fetch_assoc()) {
                // Format the date
                $row['date_sent'] = date("F d, Y \a\\t g:i a", strtotime($row['date_sent']));

                // Add the result to the response array
                $response[] = $row;
            }
            // Close the result set
            $result->close();

            // Set response status to success
            $response['status'] = 'success';
        } else {
            // No history found
            $response['status'] = 'error';
            $response['message'] = 'No history found';
        }
    } else {
        // Error fetching histories
        $response['status'] = 'error';
        $response['message'] = 'Error fetching histories: ' . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // Error preparing the statement
    $response['status'] = 'error';
    $response['message'] = 'Error preparing statement: ' . $conn->error;
}

// Close the database connection
$conn->close();

// Output the response as JSON
echo json_encode($response);
?>
