<?php
include("util/navbar.php"); 
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5/css/bootstrap.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Home Page</title>
	<script src="/js/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/stylesheet_home.css">
	<link rel="stylesheet" type="text/css" href="css/stylesheet_essai.css">
</head>
<body>
	<div class="main_container">
		<div class="header">
			
			
		</div>
		
     <form method="post" action="result.php">
		<div class="container">
			<div class="search"><input id="search"type="text" placeholder="Nom" name="search_button">
			<select name="search-specialite" id="search-specialite" >
            <option value="search-specialite"disabled selected hidden>choisir une spécialité</option>
			<option value=""></option>
            <option value="Chiropracteur">Chiropracteur</option>
            <option value="Diabétologue">Diabétologue</option>
            <option value="Stomatologue">Stomatologue</option>
            <option value="Radiologue">Radiologue</option>
            <option value="Cardiologue">Cardiologue</option>
            <option value="Pédiatre">Pédiatre</option>
            <option value="Chirurgien-général">Chirurgien général</option>
            <option value="généraliste">généraliste</option> 
            <option value="dentist">Dentiste</option>  
            <option value="Dermatologue">Dermatologue</option>
			
        </select>
        <select name="search-ville" id="search-ville" >
            <option value=""disabled selected hidden>Choisir une ville</option>
			<option value=""></option>
            <option value="casablanca">Casablanca</option>
            <option value="agadir">Agadir</option>
            <option value="fez">Fez</option>
            <option value="tanger">Tanger</option>
        </select>
			
		</div>
	</div> 
	</form>
	<div id="search_result"></div>
	
<script>
	$(document).ready(function() {
    $("#search").keyup(function(){
		///the value of the  input
		let input=$(this).val();
		let specialite_select=$("#search-specialite").val();
		let ville_select=$("#search-ville").val();
		
		if(input!=""){
			$.ajax({

				url:"search_config.php",
				method:"POST",
				data:{input:input , ville_select:ville_select , specialite_select:specialite_select},
				success:function(data){
                  $("#search_result").html(data);
				  $("#search_result").css("display","block");
				}
			})
		}
		else   $("#search_result").css("display","none");
	});
	});
</script>





</body>
</html>