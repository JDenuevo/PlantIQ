<?php
// Include your userconfig.php file here
include 'userconfig.php';

$plantId = mysqli_real_escape_string($conn, $_POST['plant_id']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$macaddress = mysqli_real_escape_string($conn, $_POST['mac_address']);
$plantImg = mysqli_real_escape_string($conn, $_POST['plant_img']);
$plantName = mysqli_real_escape_string($conn, $_POST['plant_name']);

$sql4 = "SELECT * FROM plantiq_plants WHERE email = '$email' AND mac_address = '$macaddress'";
$result4 = $conn->query($sql4);

if ($result4->num_rows > 0) {
    while ($row4 = $result4->fetch_assoc()) {
        $device_name = $row4['device_name'];
        $date_planted = date('Y-m-d', strtotime($row4['date_planted']));
        if (!empty($device_name)) {
            if (empty($date_planted)) {
                $modified = true;
            } else {
                $expected_harvest = date('Y-m-d', strtotime($date_planted . '+3 weeks'));
                $modified = true;
            }
        } else {
            $modified = false;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['addPlant'])) {
    // Check if the necessary fields are set in the POST data
    if (isset($_POST['plant_id'], $_POST['email'], $_POST['mac_address'], $_POST['plant_img'], $_POST['plant_name'])) {
        // Retrieve data from the POST data
        if ($modified) {
            // Insert the data into the database
            $insertQuery = "INSERT INTO plantiq_plants (email, mac_address, plant_img, plant_name, date_planted, expected_harvest) VALUES ('$email', '$macaddress', '$plantImg', '$plantName', " . ($date_planted ? "'$date_planted'" : 'NULL') . ", '$expected_harvest')";
        } else {
            // Insert the data into the database
            $insertQuery = "INSERT INTO plantiq_plants (email, mac_address, plant_img, plant_name, date_planted, expected_harvest) VALUES ('$email', '$macaddress', '$plantImg', '$plantName', NULL, NULL)";
        }
        $result = mysqli_query($conn, $insertQuery);

        if ($result) {
            // Redirect to the page with the modal
            header("Location: ../pages/adddevice.php?modal=1");
            exit();
        } else {
            // Insertion failed
            echo "Error: " . mysqli_error($conn);
            // Handle the error as needed
        }
    } else {
        // Required fields not set in the POST data
        echo "Error: Required fields not set in the POST data.";
        // Handle the error as needed
    }
}

mysqli_close($conn);
?>
