<?php 
session_start();
include 'dbconfig.php';


if (!isset($_SESSION['email'])) {
    header('Location: ../index.php');
    exit();
}

?>
