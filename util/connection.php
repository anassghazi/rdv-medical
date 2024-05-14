<?php
$servername = "localhost";  // Nom de l'hôte
$username = "root";         // Nom d'utilisateur
$password = "";             // Mot de passe
$dbname = "projet"; // Nom de la base de données

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
