<?php

session_start();

include("connection.php");

// Récupérer les données du formulaire
$email = $_POST['email'];
$password_input = $_POST['password'];

// Préparer la requête
$stmt = $conn->prepare("SELECT id, email, password, role FROM utilisateurs WHERE email = ?");
$stmt->bind_param("s", $email);

// Exécuter la requête
$stmt->execute();

// Récupérer le résultat
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && $password_input===$user['password']) {
    $_SESSION['utilisateur_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_role'] = $user['role'];

    $role = '';
    if ($user['role'] === 'medecin') {
        $doctor_query = $conn->prepare("SELECT id, nom, specialite FROM medecins WHERE utilisateur_id = ?");
        $doctor_query->bind_param("i", $user['id']);
        $doctor_query->execute();
        $doctor_result = $doctor_query->get_result();
        $doctor_data = $doctor_result->fetch_assoc();
        $_SESSION['medecin_data'] = $doctor_data;
        $role = 'medecin';
    } elseif ($user['role'] === 'patient') {
        $patient_query = $conn->prepare("SELECT id, nom FROM patients WHERE utilisateur_id = ?");
        $patient_query->bind_param("i", $user['id']);
        $patient_query->execute();
        $patient_result = $patient_query->get_result();
        $patient_data = $patient_result->fetch_assoc();
        $_SESSION['patient_data'] = $patient_data;
        $role = 'patient';
    }

    echo json_encode(['success' => true, 'role' => $role, 'message' => 'Connexion réussie.']);

} else {
    // Email ou mot de passe incorrect, afficher un message d'erreur
    echo json_encode(['success' => false, 'message' => 'Email ou mot de passe incorrect.']);

}

// Fermer la connexion
$stmt->close();
$conn->close();
?>

