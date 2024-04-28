<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
     <title>Document</title>
     <style>
      .barre_de_recherche{
        height:220px;
        width: 1050px;
       padding: 100px;
       margin: 250px;
       margin-top: 130px;
       padding-top: 50px;
       background-color: #083344;
       border-radius: 12px;
       position: relative;
      }
      .input{
        height: 60px;
        width: 200px;
        margin-top: 24px;
        text-align: center;
        margin-right: 6px;
        border-radius: 8px;
        font-size: 130%;
        
      }
      .button{
        background-color: black;
        color: white;
      }
      </style>

</head>
<body>
  <nav class="navbar navbar-light bg-cover bg-cyan-950 ">
  <div class="container-fluid ">
    <a class="navbar-brand text-white" href="http://localhost:9000/util/mainpage.php">LOGO</a>
    <a href="http://localhost:9000/login.php" class="btn btn-dark text-white border border-light">Se connecter</a>
  </div>
</nav>
<div>
<div class="barre_de_recherche">
  <form action="" method="post">
  <input type="text" placeholder="nom" name="search" class="input">
  <select name="" id="" class="input">
  <option value="specialite">specialite</option>
    <option value="Chiropracteur">Chiropracteur</option>
    <option value="Diabétologue">Diabétologue</option>
    <option value="Dentiste">Dentiste</option>
    <option value="Dermatologue">Dermatologue</option>
  </select>
  <select name="" id="" class="input">
  <option value="ville">ville</option>
    <option value="casablanca">casablanca</option>
    <option value="agadir">agadir</option>
    <option value="fez">fez</option>
    <option value="tanger">tanger</option>
  </select>
  <input type="submit" placeholder="search"  name="submit-search" class="input button" >
  </form>
</div>
</div>

<div>
<?php
 $sql="SELECT * FROM medecin";
 $result=mysqli_query($conn,$sql);
 $queryResults=mysqli_num_rows($result);
 if($queryResults > 0){
  while($row=mysqli_fetch_assoc($result)){
    echo "<div>
               <h3>".$row['nom']."</h3>
               <p>".$row['prenom']."</p>
               <p>".$row['specialite']."</p>
               <p>".$row['ville']."</p>
         </div>";
  }
 }
?>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
