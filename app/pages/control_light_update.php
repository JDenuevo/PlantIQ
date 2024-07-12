<?php
session_start();
include '../php/userconfig.php';
// $macaddress = $_POST['macaddress']; change this when the data is already loop
$macaddress = $_SESSION['macaddress'];

if(isset($_POST['buttonState'])) {
    $buttonState = $_POST['buttonState'];
    
    // Update the light state in the database
    $sql = "UPDATE plantiq_lights SET state='$buttonState' WHERE macaddress ='$macaddress'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Light state updated successfully";
    } else {
        echo "Error updating light state: " . $conn->error;
    }
}
$conn->close();
 header("Location: home.php");
?>