<?php
// Include your database connection code here
include '../php/userconfig.php';

// Get selected options from the Ajax request
$selectedDevice = $_POST['device'];
$email = $_POST['email'];

// Modify your SQL query to fetch plants and their count based on selected options
$sql = "SELECT plant_name, plant_img, COUNT(plant_name) as plant_count FROM plantiq_plants WHERE email = '$email' AND mac_address = '$selectedDevice' AND (isHarvested = 0 OR isHarvested IS NULL) GROUP BY plant_name, plant_img";
$result = $conn->query($sql);

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    $plants = array();
    while ($row = $result->fetch_assoc()) {
        // Combine plant name, image, and count in the response
        $plants[] = array(
            'plant_name' => $row['plant_name'],
            'plant_img' => $row['plant_img'],
            'plant_count' => $row['plant_count']
        );
    }
    echo json_encode($plants);
} else {
    echo json_encode(array('error' => 'No plants found.'));
}
?>
