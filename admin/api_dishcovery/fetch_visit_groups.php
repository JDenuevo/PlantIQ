<?php
require 'dbconfig.php';

session_start();
$email = isset($_POST['email']) ? $_POST['email'] : $_SESSION['email'];

// Set content type header to application/json
header('Content-Type: application/json');

// Define the SQL query
$sql = "SELECT 
    community_name,
    COUNT(*) AS number_of_members,
    MIN(date_created) AS date_created
FROM 
    tbl_communities
WHERE 
    community_name IN (SELECT community_name FROM tbl_communities WHERE user_who_joined = ?)
GROUP BY 
    community_name";

// Prepare the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if there was an error
if ($result === false) {
    echo json_encode([
        "error" => $conn->error
    ]);
} else {
    $communities = [];
    
    // Fetch data and format the response
    while ($row = $result->fetch_assoc()) {
        $row['date_created'] = date("F j, Y", strtotime($row["date_created"]));
        $communities[] = $row;
    }
    
    // Return the JSON response
    echo json_encode([
        "data" => $communities,
        "message" => count($communities) > 0 ? "Communities found" : "No communities found"
    ]);
}

// Close the statement and the database connection
$stmt->close();
$conn->close();
?>
