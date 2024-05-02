  <?php
  include("connection.php");
  include("header.php");
  include("searchbar.php");
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <style>
        .barre_de_recherche{
            margin: 15px;
            margin-top: 15px;
            width: 1484px;
            padding-left: 269px;
        }
        .card{
            height: 180px;
            text-align: center;
            background-color:white ;
          }

      </style>
      <title>Search Medecin</title>
  </head>
  <body> 
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
                     <h5 class=''>".$row['nom']."</h5> 
                     <h6 class=''>".$row['prenom']."</h6> 
                     <p class=''>Spécialité: ".$row['specialite']."</p>
                     <p class=''>Ville: ".$row['ville']."</p>
                     <a href='http://localhost:9000/util/rendezvous.php?id_medecin=".$row['id']."' class='btn btn-dark text-white border border-light'>RDV</a>
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
  </div>
  
  </body>
  </html>
