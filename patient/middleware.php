<?php

session_start();

if (!isset($_SESSION['patient_data'])) {
    // Redirect to login page
    header('Location: /login.php');
    exit;
}


?>
