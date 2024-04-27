<?php
include("connection.php");
include("recherche.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-light bg-cover bg-cyan-950 ">
  <div class="container-fluid ">
    <a class="navbar-brand text-white" href="http://localhost:9000/util/mainpage.php">LOGO</a>
    <a href="http://localhost:9000/login.php" class="btn btn-dark text-white border border-light">Se connecter</a>
  </div>
</nav>






<hI>Search page</hl> 
<div class="article-container">
<?php
if(isset($_POST['submit-search'])){
$search = mysqli_real_escape_string($conn, $_POST[ 'search']);
$sql="SELECT * FROM medecin WHERE nom  LIKE '%search%' OR prenom LIKE '%search%' OR 
      specialite LIKE '%search%' OR specialite LIKE '%search%' ";
$result=mysqli_query($conn, $sql);
$queryResu1t=mysqli_num_rows($result);
echo "there are ".$queryResults."results!";
if($queryResults > 0){
  while($row=mysqli_fetch_assoc($result)){
    echo "<div>
               <h3>".$row['nom']."</h3>
               <p>".$row['prenom']."</p>
               <p>".$row['specialite']."</p>
               <p>".$row['ville']."</p>
         </div>";
     }
   }else{
    echo "there are no results matching your search!";
   }
 }
 ?>
 </div>



</body>
</html>