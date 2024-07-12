<?php
$servername = "localhost";
$username = "xsmdaevu_userplantiq";
$password = "1{V{EYLmvO?r";
$dbname = "xsmdaevu_appplantiq";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>
