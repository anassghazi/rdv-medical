<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .barre_de_recherche {
            height: 220px;
            width: 1050px;
            padding: 100px;
            margin: 250px;
            margin-top: 130px;
            padding-top: 50px;
            background-color: #083344;
            border-radius: 12px;
            position: relative;
        }
        .input {
            height: 60px;
            width: 200px;
            margin-top: 24px;
            text-align: center;
            margin-right: 6px;
            border-radius: 8px;
            font-size: 130%;
        }
        .button {
            background-color: #2F4F4F;
            color: white;
            border-width: 1px;
            border-color: white ;
        }
        .button:hover {
            background-color: black;
            color: white;
            border-width: 1px;
            border-color: white ;
        }
        
    </style>
</head>
<body>

<div class="barre_de_recherche">
    <form action="recherche.php" method="post">
        <input type="text" placeholder="Nom" name="search-nom" class="input">
        <select name="search-specialite" class="input">
            <option value="">Choisir une spécialité</option>
            <option value="Chiropracteur">Chiropracteur</option>
            <option value="Diabétologue">Diabétologue</option>
            <option value="Dentiste">Dentiste</option>  
            <option value="Dermatologue">Dermatologue</option>
        </select>
        <select name="search-ville" class="input">
            <option value="">Choisir une ville</option>
            <option value="casablanca">Casablanca</option>
            <option value="agadir">Agadir</option>
            <option value="fez">Fez</option>
            <option value="tanger">Tanger</option>
        </select>
        <input type="submit" value="Search" name="submit-search" class="input button">
    </form>
</div>
</body>
</html>