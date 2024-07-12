<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include '../php/userconfig.php';

if(isset($_POST['email']) && isset($_POST['macaddress'])) {
    $email = $_POST['email'];
    $macaddress = $_POST['macaddress'];
    $_SESSION['macaddress'] = $macaddress;

// Check if there is a record in the plantiq_binding database
    $sql = "SELECT * FROM plantiq_availablemacaddresses WHERE macaddress = '$macaddress'";
    $run = $conn->query($sql);

    if ($run->num_rows > 0) {
        
        // Check if there is a record in the plantiq_binding database
        $checkQuery = "SELECT * FROM plantiq_binding WHERE email = '$email' AND macaddress = '$macaddress'";
        $checkResult = $conn->query($checkQuery);
    
        if ($checkResult->num_rows > 0) {
            // Record exists in plantiq_binding, return a message indicating the user is already connected
            echo '<script>alert("User is already connected to this device");</script>';
            echo '<script>window.location.href = "home.php";</script>';
        } else {
            // Record doesn't exist in plantiq_binding, insert new data
            $insertBindingQuery = "INSERT INTO plantiq_binding (email, macaddress) VALUES ('$email', '$macaddress')";
            
            if ($conn->query($insertBindingQuery) === TRUE) {
                // Set the timezone to Manila
                date_default_timezone_set('Asia/Manila');
                
                // Insert into plantiq_espconnection table
                $timestamp = date('Y-m-d H:i:s'); // current timestamp in Manila
                $insertEspConnectionQuery = "INSERT INTO plantiq_espconnection (macaddress, timestamp) VALUES ('$macaddress', '$timestamp')";
                if ($conn->query($insertEspConnectionQuery) === TRUE) {
                    // Check if there is any data in plantiq_lights
                    $checkLightsQuery = "SELECT * FROM plantiq_lights";
                    $checkLightsResult = $conn->query($checkLightsQuery);
                    
                    if ($checkLightsResult->num_rows == 0) {
                        // No data in plantiq_lights, insert new data
                        $insertLightsQuery = "INSERT INTO plantiq_lights (email, macaddress, state) VALUES ('$email', '$macaddress', 'off')";
                        
                        if ($conn->query($insertLightsQuery) === TRUE) {
                            echo '<script>window.location.href = "adddevice.php?modal1";</script>';
                        } else {
                            echo '<script>alert("Error inserting initial record in plantiq_lights:'. $conn->error .'");</script>';
                            echo '<script>window.location.href = "home.php";</script>';
                        }
                    } else {
                        // Data exists in plantiq_lights, insert new record if email and macaddress don't exist
                        $checkExistingQuery = "SELECT * FROM plantiq_lights WHERE email = '$email' AND macaddress = '$macaddress'";
                        $checkExistingResult = $conn->query($checkExistingQuery);
                        
                        if ($checkExistingResult->num_rows == 0) {
                            // Email and macaddress don't exist in plantiq_lights, insert new record
                            $insertLightsQuery = "INSERT INTO plantiq_lights (email, macaddress, state) VALUES ('$email', '$macaddress', 'off')";
                            
                            if ($conn->query($insertLightsQuery) === TRUE) {
                                echo '<script>window.location.href = "adddevice.php?modal1";</script>';
                            } else {
                                echo '<script>alert("Error inserting new record in plantiq_lights: '. $conn->error .'");</script>';
                                echo '<script>window.location.href = "home.php";</script>';
                            }
                        } else {
                            echo '<script>alert("Email and macaddress already exist in plantiq_lights");</script>';
                            echo '<script>window.location.href = "home.php";</script>';
                        }
                    }
                } else {
                    echo '<script>alert("Error inserting record in plantiq_espconnection:'. $conn->error .'");</script>';
                    echo '<script>window.location.href = "home.php";</script>';
                }
            } else {
                echo '<script>alert("Error connecting user in plantiq_binding: '. $conn->error .'");</script>';
                echo '<script>window.location.href = "home.php";</script>';
            }
        }
    } else {
         echo '<script>alert("Invalid MAC ADDRESS please try again!");</script>';
         echo '<script>window.location.href = "home.php";</script>';
    }
} else {
    echo "";
    echo '<script>alert("Invalid data received");</script>';
    echo '<script>window.location.href = "home.php";</script>';
}

$conn->close();
?>
