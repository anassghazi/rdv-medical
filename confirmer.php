
<?php 
include("util/connection.php"); 
include("util/navbar.php");
/*
session_start();
if(isset($_SESSION['user_id'])) {
    // L'utilisateur est connecté
} else {
    // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: login.php");
    exit;
}*/
$id_medecin = isset($_GET['id_medecin']) ? $_GET['id_medecin'] : 'inconnu';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de Rendez-Vous</title>
    <style>
        .rendezvous-info{
            margin-left:1000px;
            height: 200px;
            width:  280px;
            border-width: 1px;
            border-radius: 12px;
            text-align:center;
        }
        .renseignement{
            margin: 100px;
            
        }
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
        .confirmation .etape_precedente{
            margin-left: -450px;
        }
        .doctor-image{
            height:70px;
            width: 70px;
            border-radius:450px;
            margin-top:-65px;
            margin-left:5px;
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
    <div class="renseignement">
    <h1                 >Prenez votre rendez-vous en ligne</h1>
    <p>Renseignez les informations suivantes</p>
    </div>
    <?php
    // Check if the doctor's ID is passed as a query parameter
    if(isset($_GET['id_medecin'])) {
    $doctorId = mysqli_real_escape_string($conn, $_GET['id_medecin']);
    
    // Fetch doctor's data from the database
    $query = "SELECT * FROM medecin WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $doctorId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)) {
        ?> <div class="rendezvous-info">
        <?php
        echo "<br>";
        echo "<p>Dr. " . $row['nom'] . " " . $row['prenom'] . "</p>";
        echo "<p> " . $row['specialite'] . "</p>";
        echo "<p> " . $row['ville'] . "</p>";
        echo "<img src='" . $row['image'] . "' alt='Doctor Image' class='doctor-image'>";
        echo " <p> " . $row['localisation'] . "</p>";
        ?>
        </div>
       <?php
    } else {
        echo "<p>No doctor found.</p>";
    }
} else {
    echo "<p>No doctor ID provided.</p>";
}
?>
    <div class="confirmation">
        <h2>confirmez l'heure du rendz-vous</h2>
        <p>Vous avez sélectionné le <?php echo $formattedDate; ?> à <?php echo $formattedHour; ?>.</p>
        <button class="continuer"  onclick="window.location.href = 'verification.php';">continuer</button>
    </div>
  
</body>
</html>