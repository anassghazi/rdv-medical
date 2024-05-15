<?php 
include("util/connection.php"); 
include("util/navbar.php");

$id_medecin = isset($_GET['id_medecin']) ? $_GET['id_medecin'] : 'inconnu';
$id_patient = isset($_GET['id_patient']) ? $_GET['id_patient'] : 'inconnu';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>verification</title>
    <style>
        
        .continuer{
            background-color: #083344;
            color: white;
            height: 30px;
            width: 80px;
            border-radius: 6px;
            margin-top: 60px;
        }
        .confirmation{
            height: 200px;
            width: 800px;
            border-width: 1px;
            border-radius: 12px;
            margin-top: -196px;
            margin-left: 100px;
            text-align: center;
        }
        .verification{

        }
       
    </style>
</head>
<body>
   <?php
     setlocale(LC_TIME, 'fr_FR.utf8', 'fr_FR', 'fr_FR@euro', 'french');
     $date = isset($_GET['date']) ? $_GET['date'] : 'inconnue';
     $hour = isset($_GET['hour']) ? $_GET['hour'] : 'inconnue';
     $formattedDate = strftime('%A %d %B %Y', strtotime($date));
     $formattedHour = date('H:i', strtotime($hour));
    ?>
    
    <?php
    // Check if the patient's ID is passed as a query parameter
    if(isset($_GET['id_patient'])) {
    $patientId = mysqli_real_escape_string($conn, $_GET['id_patient']);
    
    // Fetch doctor's data from the database
    $query = "SELECT * FROM patient WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $patientId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)) {
        ?> <div class="verification">
        <?php
        echo "<p> " . $row['telephone'] . "</p>";
        ?>
        </div>
       <?php
    } else {
        echo "<p>No patient found.</p>";
    }
} else {
    echo "<p>No patient ID provided.</p>";
}
?>

    <div class="confirmation">
       
    </div>
  
</body>
</html>