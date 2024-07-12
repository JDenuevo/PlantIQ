<?php
error_reporting(0);
include '../php/userconfig.php';

$macaddress = $_GET['macaddress']; //change to post when in the main system


$query = "SELECT * FROM plantiq_lights WHERE macaddress = '$macaddress'";
$result = mysqli_query($conn, $query);

if ($result) {
    // Fetch the last button state
    $row = mysqli_fetch_assoc($result);
    $buttonState = $row['state'];
    $macaddress = $row['macaddress'];
    
    // Set up the response array
    $response = [
        'success' => true,
        'buttonState' => $buttonState,
        'macaddress' => $macaddress
    ];
} else {
    // If there was an error in the database query
    $response = [
        'success' => false,
        'error' => 'Error fetching data from the database'
    ];
}


// Send the JSON response wrapped in HTML comments
    echo '<!--' . json_encode($response) . '-->';

?>