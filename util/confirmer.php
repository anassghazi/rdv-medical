
<?php 
include("navbar.php");
?>
<?php
setlocale(LC_TIME, 'fr_FR.utf8', 'fr_FR', 'fr_FR@euro', 'french');
$date = isset($_GET['date']) ? $_GET['date'] : 'inconnue';
$hour = isset($_GET['hour']) ? $_GET['hour'] : 'inconnue';
$formattedDate = strftime('%A %d %B %Y', strtotime($date));
$formattedHour = date('H:i', strtotime($hour));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de Rendez-Vous</title>
</head>
<body>
    <p>Vous avez sélectionné le <?php echo $formattedDate; ?> à <?php echo $formattedHour; ?>.</p>
</body>
</html>