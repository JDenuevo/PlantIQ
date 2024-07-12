<?php 
include '../php/userconfig.php';
session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}

if(!isset($_SESSION["status"]) || $_SESSION["status"] !== "Logged In"){
    header("location: ../index.php");
    exit;
}
?>