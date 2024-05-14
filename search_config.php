<?php
include("util/connection.php");
if (isset($_POST['input']))
{
    $input=$_POST["input"];
    $specialite_select=$_POST["specialite_select"];
    $ville_select=$_POST["ville_select"];
    $query="SELECT id,nom,prenom,specialite,ville,image FROM medecin WHERE nom LIKE '{$input}%' OR prenom LIKE '{$input}%'and (specialite = '$specialite_select' OR ville ='$ville_select')";
    $result=mysqli_query($conn,$query);

    if(mysqli_num_rows($result)>0){?>
      <table class="table table-bordered table -striped mt-4">
     <?php  while($row =mysqli_fetch_assoc($result)){
       
        $nom=$row['nom'];
        $prenom=$row['prenom'];
        $specialite=$row['specialite'];
        $ville=$row['ville'];
        $image=$row['image'];
       
        ?>
        <tr>
        <div class="doctor-card">
    <img src="<?php echo $image?>"alt="Doctor Image" class="doctor-image">
    <div class="doctor-info">
        <h2 class="doctor-name"><?php echo"DR.$nom $prenom"?></h2><div class="plusreviews"><div class="rating">
            <span class="star">&#9733;</span>
            <span class="star">&#9733;</span>
            <span class="star">&#9733;</span>
            <span class="star">&#9733;</span>
            <span class="star">&#9733;</span>
            <span class="note">4.4</span>
        </div> <div>49 reviews</div>
    </div>
        <p class="doctor-specialty"> <?php echo $specialite?></p>
        <p class="doctor-city"><?php echo $ville?></p>
    </div>

    <a href="rendezvous.php?id_medecin=<?php echo $row['id'] ?>" class="button">RDV</a>
</div>

        </tr>



        <?php
    }?>
 
     
    </table>




<?php
}else
    echo"<h6 class='text-danger text-center mt-3'>no data found</h6>";

}

?>