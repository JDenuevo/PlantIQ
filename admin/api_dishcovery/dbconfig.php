<?php
$host = 'localhost'; 
$dbname = 'xsmdaevu_dishcovery'; 
$username = 'xsmdaevu_administratorplantiq'; 
$password = '3+goOVY9QL$y'; 


$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
