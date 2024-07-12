<?php
// Include your database connection code here
include '../php/userconfig.php';

// Get selected options from the Ajax request
$selectedDevice = $_POST['device'];
$selectedDate = $_POST['date'];
$email = $_POST['email'];

// Modify your SQL query to fetch plants, their count, and isHarvested based on selected options
$sql = "SELECT plant_name, harvested_date, expected_harvest, isHarvested, COUNT(plant_name) as plant_count 
        FROM plantiq_plants 
        WHERE email = '$email' 
          AND mac_address = '$selectedDevice' 
          AND date_planted = '$selectedDate' 
        GROUP BY plant_name, harvested_date, expected_harvest, isHarvested";
$result = $conn->query($sql);

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    $plants = array();
    while ($row = $result->fetch_assoc()) {
        $expected_harvest = strtotime($row['expected_harvest']);
        $harvested_date = strtotime($row['harvested_date']);
        
        if ($row['isHarvested'] == 0) {
            $date = "Currently Planted";
        } else {
            $formatted_harvested_date = date('F j, Y', $harvested_date);
            $date = $formatted_harvested_date;
        }

        // Combine plant name, count, and isHarvested in the response
        $plants[] = array(
            'plant_name' => $row['plant_name'],
            'plant_count' => $row['plant_count'],
            'date_harvested' =>  $date
        );
    }
    echo json_encode($plants);
} else {
    echo json_encode(array('error' => 'No plants found.' . $conn->error));
}
?>
