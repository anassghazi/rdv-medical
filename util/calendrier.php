<?php
include("connection.php"); 
?>

<?php
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

$hours = ['12:00', '12:20', '12:40', '13:00', '13:20', '13:40', '14:00', '14:20', '14:40', '15:00', '15:20', '15:40', '16:00', '16:20', '16:40'];
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
            background-color: #f0f0f0;
            color: blue;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .scrollable-hours {
            overflow-y: auto;
            flex-grow: 1;
            height: 200px;
        }
        .navigation {
            flex: 0 0 40px;
        }
        .calendrier{
            margin-top: 20px;
            margin-left: 380px;
            background-color: grey;
            height: 270px;
            width: 550px;
            position: fixed;
            right: 25px;
        }
    </style>
</head>
<body>
    <div class="calendrier">
    <div class="container">
        <div class="day-column navigation"><a href="?offset=<?php echo $offset - 1; ?>">&lt;</a></div>
        <?php for ($i = 0; $i < 6; $i++): ?>
            <div class="day-column"><?php echo formatDate(strtotime("+$i days", $base_time)); ?></div>
        <?php endfor; ?>
        <div class="day-column navigation"><a href="?offset=<?php echo $offset + 1; ?>">&gt;</a></div>
    </div>
    <div class="scrollable-hours">
        <div class="day-column navigation"></div>
        <?php for ($i = 0; $i < 6; $i++): ?>
            <div class="day-column">
              <?php foreach ($hours as $hour): ?>
                <?php $day = strtotime("+$i days", $base_time); ?>
                <a href="confirmer.php?date=<?php echo urlencode(strftime('%Y-%m-%d', $day)); ?>&hour=<?php echo urlencode($hour); ?>" style="text-decoration: none;">
                <button class="hour-button"><?php echo formatHour($hour); ?></button>
                </a>
         <?php endforeach; ?>

            </div>
        <?php endfor; ?>
        <div class="day-column navigation"></div>
    </div>
    </div>
</body>
</html>