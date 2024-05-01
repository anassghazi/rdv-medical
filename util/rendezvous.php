<?php
include("connection.php"); 
include("header.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>redezvous</title>
<style>
    .doc-info{
        height: 120px;
        background-color: #0c4a6e;
        text-align: center;
        color: white;
    }
</style>
</head>
<body>
    <div class="doc-info">
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
   
        echo "<p>Dr  " . $row['nom'] . " " . $row['prenom'] . "</p>";
        echo "<p>Specialité: " . $row['specialite'] . "</p>";
        echo "<p>Ville: " . $row['ville'] . "</p>";
       
    } else {
        echo "<p>No doctor found.</p>";
    }
} else {
    echo "<p>No doctor ID provided.</p>";
}
?>
</div>
</body>
</html>