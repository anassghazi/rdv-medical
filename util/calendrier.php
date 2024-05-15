<?php
include("connection.php"); 

$doctorId = isset($_GET['id_medecin']) ? $_GET['id_medecin'] : null;


// Vérifier si un ID de médecin a été fourni
if ($doctorId !== null) {
    // Requête pour sélectionner les créneaux du médecin spécifié
    $query = "SELECT * FROM creneau WHERE medecin_id = $doctorId";
    $result = mysqli_query($conn, $query);

    // Vérifier s'il y a des erreurs dans la requête SQL
    if (!$result) {
        die("Erreur dans la requête SQL : " . mysqli_error($conn));
    }

    // Créer un tableau pour stocker les créneaux récupérés
    $doctorSlots = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // Regrouper les créneaux par jour
        $doctorSlots[$row['jour']][] = $row['heure_debut'];
    }
}

// Essayez différentes locales si 'fr_FR.utf8' ne fonctionne pas
$locales = ['fr_FR.utf8', 'fr_FR', 'fr_FR@euro', 'french'];
foreach ($locales as $locale) {
    if (setlocale(LC_TIME, $locale)) {
        break;
    }
}

$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$base_time = strtotime("+$offset days");

function formatDate($time) {
    return strftime('%A<br>%e %B', $time);  // Formate la date en français
}

function formatHour($hour) {
    return date('H:i', strtotime($hour));
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calendrier des rendez-vous</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container, .scrollable-hours {
            display: flex;
            width: 100%;
            align-items: flex-start;
        }
        .day-column {
            flex: 1;
            text-align: center;
            border: none;  
            padding: 5px;
            box-sizing: border-box;
        }
        .hour-button {
            display: block; 
            width: 80%;
            padding: 5px;
            margin: 2px auto;
            background-color: #083344;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .scrollable-hours {
            overflow-y: auto;
            flex-grow: 1;
            height: 240px;
        }
        .navigation a {
        display: inline-block;
        width: 30px;
        height: 30px;
        text-align: center;
        line-height: 30px;
        background-color: white;
        color: #083344;
        border-radius: 50%;
        text-decoration: none;
         margin: 0px;
         margin-top:5px;
        }
        .navigation a:hover {
         background-color: grey;
        }
        .calendrier{
            color:black;
            margin-top: 20px;
            margin-left: 380px;
            background-color: white;
            height: 250px;
            width: 610px;
            position: fixed;
            right: 25px;
            border-width: 1px;
            border-radius:12px;
        }
    </style>
  </head>
  <body>
  <div class="calendrier">
  <div class="container">
  <div class="scrollable-hours">
    <div class="day-column navigation"><a href="?offset=<?php echo max($offset - 1, 0); ?>&id_medecin=<?php echo $doctorId; ?>">&lt;</a></div>
    
        <?php for ($i = 0; $i < 6; $i++): ?>
            <?php $day = strtotime("+$i days", $base_time); ?>
            <?php if ($day >= strtotime('today')): ?>
                <div class="day-column">
                <?php echo formatDate($day); ?>
                <?php if(isset($doctorSlots[strtolower(strftime('%A', $day))])): ?>
                <?php foreach ($doctorSlots[strtolower(strftime('%A', $day))] as $slot): ?>
                <a href="confirmer.php?date=<?php echo urlencode(date('Y-m-d', $day)); ?>&hour=<?php echo urlencode($slot);?>&id_medecin=<?php echo $doctorId; ?>" style="text-decoration: none;">
                <button class="hour-button"><?php echo formatHour($slot); ?></button>
                </a>
                <?php endforeach; ?>
                <?php else: ?>
                <p>-</p>
                <?php endif; ?>

                </div>
            <?php endif; ?>
        <?php endfor; ?>
         
    <div class="day-column navigation"><a href="?offset=<?php echo $offset + 1; ?>&id_medecin=<?php echo $doctorId; ?>">&gt;</a></div> 
    </div>
   </div>
   </div>
        

</body>
</html>