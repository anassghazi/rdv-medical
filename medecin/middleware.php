<?php

session_start();

if (!isset($_SESSION['medecin_data'])) {
    // Redirect to login page
    header('Location: /login.php');
    exit;
}


?>
