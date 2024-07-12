<?php
include '../php/userconfig.php';
session_start();

function fetchData($type, $conn, $macaddress) {
    $query = "SELECT * FROM plantiq_realtime_log WHERE mac_address = '$macaddress' ORDER BY timestamp DESC";
    $res = $conn->query($query);

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();  // Fetch the row from the result set

        switch ($type) {
            case 'ph':
                echo formatPHData($row);
                break;
            case 'water':
                echo formatWaterData($row);
                break;
            case 'soil':
                echo formatSoilData($row);
                break;
            default:
                echo 'Invalid data type';
        }
    } else {
        switch ($type) {
            case 'ph':
                echo 'No Data Available in PH Level Sensor';
                break;
            case 'water':
                echo 'No Data Available in Water Level Sensor';
                break;
            case 'soil':
                echo 'No Data Available in Soil Moisture Sensor';
                break;
            default:
                echo 'Invalid data type';
        }
    }
}

// Function to format and display pH level data
function formatPHData($row) {
    
    if ($row['ph_level'] < 5 || $row['ph_level'] > 8.5) {
        $pltext = '<span class="text-danger fs-6">DANGER</span>';
        $plwarn = "Drain your water immediately! It may cause harm to the plant.";
    } elseif ($row['ph_level'] >= 6 && $row['ph_level'] <= 8.5) {
        $pltext = '<span class="text-primary fs-6">GOOD</span>';
        $plwarn = "The pH level of the water is good for the plant's health!";
    } elseif ($row['ph_level'] < 0) {
        $pltext = '<span class="text-dark fs-6">NO DATA</span>';
        $plwarn = "Wait for the pH level sensor to accurately record the data.";
    } else {
        $pltext = '<span class="text-warning fs-6">FAIR</span>';
        $plwarn = "The pH level of the water is acceptable for the plant! However, it is not always recommended";
    }

    return '<label class="card-title fw-bold fs-6">pH Level : <span>' . $row['ph_level'] . '</span> (' . $pltext . ')</label>
            <br>
            <p class="text-muted">' . $plwarn . '</p>';
}

// Function to format and display water level data
function formatWaterData($row) {
    if ($row['water_level'] >= 14 && $row['water_level'] <= 1000) {
        $wl = $row['water_level'];
        $wltext = '<span class="text-dark">EMPTY</span>';
        $wlwarn = "Fill up your water tank! Your plant and soil need it. THE TANK IS EMPTY!";
    } elseif ($row['water_level'] >= 10  && $row['water_level'] <= 13) {
        $wl = $row['water_level'];
        $wltext = '<span class="text-danger fs-6">LOW</span>';
        $wlwarn = "Fill up your water tank! Your plant and soil need it.";
    } elseif ($row['water_level'] >= 5 && $row['water_level'] <= 9) {
        $wl = $row['water_level'];
        $wltext = '<span class="text-success fs-6">GOOD</span>';
        $wlwarn = "The water tank is in fair level! You might need to fill it up sooner";
    }elseif($row['water_level'] > 1000){
         $wl = "0";
        $wltext = '<span class="text-primary fs-6">FULL</span>';
        $wlwarn = "The water tan1k is at a good level";
    }
    else {
        $wl = $row['water_level'];
        $wltext = '<span class="text-primary fs-6">DANGER</span>';
        $wlwarn = "The water tank is at a good level";
    }
    return '<label class="card-title fw-bold fs-6">Water Level : <span>' . $wl . '</span> (' . $wltext . ')</label>
            <br>
            <p class="text-muted">' . $wlwarn . '</p>';
}

// Function to format and display soil moisture data
function formatSoilData($row) {
    if ($row['soil_moisture'] > 65) {
        $smtext = '<span class="text-danger fs-6">DANGER</span>';
        $smwarn = "Your soil is dry. The device will water it.";
    } elseif ($row['soil_moisture'] <= 65 && $row['soil_moisture'] >= 45) {
        $smtext = '<span class="text-primary fs-6">GOOD</span>';
        $smwarn = "Your soil is in wet condition. You're good to go!";
    } elseif ($row['soil_moisture'] < 45) {
        $smtext = '<span class="text-warning fs-6">FAIR</span>';
        $smwarn = "Your soil is in fair condition. You're still good to go!";
    }

    return '<label class="card-title fw-bold fs-6">Soil Moisture : <span>' . $row['soil_moisture'] . '%</span> (' . $smtext . ')</label>
            <br>
            <p class="text-muted">' . $smwarn . '</p>';
}

// Fetch and display updated data based on the type
$type = $_GET['type'];
$macaddress = $_SESSION['macaddress'];

echo fetchData($type, $conn, $macaddress);

// Close the database connection
$conn->close();
?>