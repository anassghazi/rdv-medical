<?php
session_start();

unset($_SESSION['patient_data']);
unset($_SESSION['medecin_data']);

session_destroy();

header('Location: /login.php');
exit;
?>
