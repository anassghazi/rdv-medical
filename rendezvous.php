<?php
include("util/connection.php"); 
include("util/navbar.php"); 
$id_patient = isset($_GET['id_patient']) ? $_GET['id_patient'] : 'inconnu';
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> 
<script src="https://cdn.tailwindcss.com"></script>
<title>redezvous</title>
<style>
    .doctor-image{
        height:130px;
        width:130px;
        margin-top:-140px;
        margin-left:420px;
        border-radius:450px;
    }
    .doc-info{
    height: 140px;
    background-color: #2F4F4F;
    text-align: center;
    color: white;
}
.doc-info2{
    height: 2800px;
    background-color: #ccfbf1;
    padding: 1px;
    color: white;
}
.doc-info3{
    height: 550px;
     background-color: white;
    color: black;
    border-radius: 20px;
    margin: 12px;
    margin-top: 12px;
    margin-right: 650px;
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
        echo "<br>";
        echo "<p>Dr. " . $row['nom'] . " " . $row['prenom'] . "</p>";
        echo "<p> " . $row['specialite'] . "</p>";
        echo "<p> " . $row['ville'] . "</p>";
        echo "<img src='" . $row['image'] . "' alt='Doctor Image' class='doctor-image'>";
       
        
    } else {
        echo "<p>No doctor found.</p>";
    }
} else {
    echo "<p>No doctor ID provided.</p>";
}

?>
</div>
</div>

<div class="doc-info2">

      
    <?php 
    include("util/calendrier.php");
    ?>

   <div class="doc-info3" id="carte">
    <h1>Description</h1>
    <?php 
     if(isset($_GET['id_medecin'])) {
        $doctorId = mysqli_real_escape_string($conn, $_GET['id_medecin']);
        
        // Fetch doctor's data from the database
        $query = "SELECT * FROM medecin WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $doctorId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        if($row = mysqli_fetch_assoc($result)) { 
          echo "<p> " . $row['description'] . "</p>";
        } }
    ?>
    
   </div>
</div>
</body>  
</html>


