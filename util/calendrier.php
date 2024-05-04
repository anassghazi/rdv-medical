<?php
setlocale(LC_TIME, 'fr_FR.utf8');  // S'assure que la locale est correctement définie pour le français

$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$base_time = strtotime("+$offset days");

function formatDate($time) {
    return strftime('%A<br>%e %B', $time);
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
        .container {
            display: flex;
            width: 100%;
            align-items: flex-start;
        }
        .day-column {
            flex: 1;
            text-align: center;
            border: 1px solid #ddd;
            padding: 5px;
            box-sizing: border-box; /* Include padding in width calculation */
        }
        .hour-button {
            display: block;
            width: 80%; /* Slightly increase button width for better touch targets */
            padding: 5px;
            margin: 2px auto;
            background-color: #f0f0f0;
            color: blue;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .scrollable-hours {
            display: flex;
            width: 100%;
            align-items: flex-start;
            overflow-y: auto;
            flex-grow: 1; /* Allow the scrollable area to take up available space */
        }
        .navigation {
            flex: 0 0 40px;
        }

        @media (max-width: 600px) {
            .day-column, .navigation {
                flex: 1 0 20%; /* Adapt columns for smaller screens */
            }
            .hour-button {
                width: 100%; /* Full width buttons on smaller screens */
            }
        }
    </style>
</head>
<body>
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
                    <button class="hour-button"><?php echo formatHour($hour); ?></button>
                <?php endforeach; ?>
            </div>
        <?php endfor; ?>
        <div class="day-column navigation"></div> 
    </div>
    
</body>
</html>