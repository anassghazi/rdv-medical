<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
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
            background-color: black;
            color: white;
        }
        .card{
          background-color: #083344;
          width: 150px;
          color: white;
          margin: 350px;
          
        }
        
    </style>
</head>
<body>
<nav class="navbar navbar-light bg-cover bg-cyan-950">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="http://localhost:9000/util/mainpage.php">LOGO</a>
        <a href="http://localhost:9000/login.php" class="btn btn-dark text-white border border-light">Se connecter</a>
    </div>
</nav>

<div class="barre_de_recherche">
    <form action="" method="post">
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

<div>
<?php
if (isset($_POST['submit-search'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['search-nom']);
    $specialite = mysqli_real_escape_string($conn, $_POST['search-specialite']);
    $ville = mysqli_real_escape_string($conn, $_POST['search-ville']);

    $query = "SELECT * FROM medecin WHERE 1=1";
    $conditions = [];
    $params = [];
    $types = "";

    if (!empty($nom)) {
        $conditions[] = "nom LIKE CONCAT('%', ?, '%')";
        $params[] = $nom;
        $types .= "s";
    }
    if (!empty($specialite) && $specialite != "") {
        $conditions[] = "specialite = ?";
        $params[] = $specialite;
        $types .= "s";
    }
    if (!empty($ville) && $ville != "") {
        $conditions[] = "ville = ?";
        $params[] = $ville;
        $types .= "s";
    }

    if (!empty($conditions)) {
        $query .= " AND " . implode(' AND ', $conditions);
        $stmt = mysqli_prepare($conn, $query);
        if ($stmt && !empty($params)) {
            mysqli_stmt_bind_param($stmt, $types, ...$params);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                echo "<div class='row'>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='col-md-4 mb-4'>
                     <div class='card'>
                     <div class='card-body'>
                     <h5 class='card-title'>".$row['nom']."</h5> 
                     <h6 class='card-subtitle mb-2 text-muted'>".$row['prenom']."</h6> 
                     <p class='card-text'>Spécialité: ".$row['specialite']."</p>
                     <p class='card-text'>Ville: ".$row['ville']."</p>
                     </div>
                     </div>
                     </div>";
                }
                echo "</div>"; // row
            } else {
                echo "No results matching your search!";
            }
        }
    } else {
        echo "Please enter search criteria!";
    }
}
?>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
