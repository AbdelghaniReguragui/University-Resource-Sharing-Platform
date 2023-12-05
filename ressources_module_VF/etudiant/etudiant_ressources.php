<?php
include('session.php');
define('MAX_SIZE', 100000);
$id_element_module = "";
$nom_element_module = "";

if(!($_SERVER["REQUEST_METHOD"] == "POST") && !isset($_SESSION['id_elt_module'])){

    header("location: etudiant_page.php");
	
	
}else{
   if(isset($_POST['id_element_module'])){
        $_SESSION['id_elt_module']=$_POST['id_element_module'];
        $_SESSION['elt_module']=$_POST['element_module'];
    
   $id_elt_module=$_SESSION['id_elt_module'];
   $nom_element_module=$_POST['element_module'];
   }
   else{
    $id_elt_module=$_SESSION['id_elt_module'];
   $nom_element_module=$_SESSION['elt_module'];
   
   }
   }
	


?>


<html class="h-100">
   
   <head>
      <title><?php echo $nom_element_module ; ?></title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap/style.css" rel="stylesheet">
	<script> 
	</script>
   </head>
   
   <body class="h-100">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/script.js"></script>
        <div  class="container-fluid pr-0 pl-0 h-100 d-flex flex-column">
            <nav class="navbar navbar-expand-lg navbar-dark  bg-primary d-flex">
                <a class="navbar-brand" href="etudiant_page.php">Acceuil</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                    <div class="navbar-nav mr-auto">
                        <a class="nav-item nav-link " href="etudiant_ressources.php">Ressources<span class="sr-only">(current)</span></a>                    </div>
                    <div class="navbar-nav  d-flex justify-content-center">
                        <span class="text-center" > Espace Etudiant</span>

                    </div>
                    <div class="navbar-nav ml-auto">
                        <a class="nav-item nav-link bg-info mb-2 mr-sm-2 mb-sm-0" href = "profile_update.php"><?php echo $etudiant_name; ?></a>
                        <a class="nav-item nav-link bg-danger rounded" href = "etudiant_logout.php">Deconnexion</a>
                    </div>
                </div>
            </nav>
            
            
             <div class="container-fluid " style="background-color:#e6f0ff;">
   
	  <h1><center><span class="badge badge-pill badge-primary mt-4 mb-5"><?php echo $nom_element_module ; ?></span> </center></h1>
  
	 <div class="row">
   <div class="col-md-3" style="background-color:#008ae6;" id="leftside">
   <?php

$sql = "select * from module  JOIN annee_formation ON module.id_af=annee_formation.id_af JOIN filiere ON filiere.id_filiere=annee_formation.id_filiere where annee_formation.id_af = '$id_af'";
$result = mysqli_query($link,$sql);
// echo mysqli_error($link);
// 	echo '<div class="container-fluid mt-4 col-md-11  bg-primary rounded" style="background-color:#cce0ff;" >';
while ($row = $result->fetch_assoc()) {
// echo mysqli_error($link);
    
    echo '<div class="d-flex justify-content-center " style="background-color:#99c2ff;" >
            <div class="panel panel-default mt-2 mb-2 col-md-11 rounded"  style="background-color:#99c2ff;">';
    echo '  <div class="panel-heading d-flex justify-content-center" >
                    
                </div>
                <div class="panel-body d-flex justify-content-center" >
                <div class="card w-75 col-8 mt-4 col-md-12" >
            <div class="card-header text-center" style="background-color:#9ea4b2;">
                <h5><h2 class=" text-dark">'.$row['nom_module'].'</h2></h5>
            </div>  
            <div class="card-body" style="background-color:#f5f3f2;">
                ';
	

	
	
	//suppression et modification de section 
	
	//modifier section

	
	
	
	//affichage de ressource
 	$id_module = $row['id_module'].'deeeee';
	$sql = "select * FROM element_module WHERE id_module=".$row['id_module']; 
	$Result = mysqli_query($link,$sql);
// 	echo mysqli_error($link);
	while ($Row = $Result->fetch_assoc()) {
		
		
		//suppression de la ressource 
		
		//en cliquant sur la boutton supprimer, ca va afficher la button qui est responsable sur la suppression 
		echo '
		
		<div class="edit_af" >
            <form method="POST" action="etudiant_ressources.php" id="'.$Row['id_element_module'].'">
            <input type="hidden" name="id_element_module" value="'.$Row['id_element_module'].'" >
            <input type="hidden" name="element_module" value="'.$Row['nom_element_module'].'" >
            <input type = "submit" value = " Submit "/>
            </form>
		</div>
	';
	$param=''.$Row['id_element_module'].'';
		
        echo 
            
              '<h4><a href="javascript:submitForm('.$param.')">'.$Row['nom_element_module'].'</a></h4>'
			      
                
            ;
		
		
		

	
	
		
		
		
		
	}
	


	
	
	
	
	
	
	
	echo '</div></div></div></div></div>';
	
	
}
	
            
?> 
   </div>
   <div class="col-md-9" id="rightside">

	  
	  
	  
	  




<?php 
$sql = "select * from section LEFT JOIN element_module ON section.id_element_module = element_module.id_element_module WHERE section.id_element_module =".$id_elt_module;
$result = mysqli_query($link,$sql);
$count = mysqli_num_rows($result);
echo mysqli_error($link);

while ($row = $result->fetch_assoc()) {
	
	echo '<div class="container-fluid mt-2 mb-2 col-md-11  rounded" style="background-color:#cce0ff;" ><div class="d-flex justify-content-center"><h1><center><span class="badge badge-pill mt-3" style="background-color:#f5f3f2;">'.$row['nom_section'].'</span> </center></h1></div>';
	
	
	//suppression et modification de section 
	

	

	
	
	
	//affichage de ressource
	$id_section = $row['id_section'];
	$sql = "select * from ressource LEFT JOIN section ON ressource.id_section=section.id_section LEFT JOIN element_module ON section.id_element_module = element_module.id_element_module LEFT JOIN module ON element_module.id_module = module.id_module LEFT JOIN annee_formation ON module.id_af=annee_formation.id_af LEFT JOIN filiere ON filiere.id_filiere=annee_formation.id_filiere where section.id_section = '$id_section'"; 
	$Result = mysqli_query($link,$sql);
	while ($Row = $Result->fetch_assoc()) {
        echo '<div class="mb-2" >';
		$FileType = $Row['type'];
		
		
		//suppression de la ressource 
		
		//en cliquant sur la boutton supprimer, ca va afficher la button qui est responsable sur la suppression 
		echo '
	';
		
        echo '<div class="card col-8 mt-4 col-md-12" >
            <div class="card-header text-center" style="background-color:#9ea4b2;">
                <h5>'.$Row['nom_ressource'].'</h5>
            </div>
                <div class="card-body">
                <h6 class="card-title">'.$Row['description'].'</h6>
			      
                
            ';
		
		if( $FileType == "image"  ){
		

			echo '
			<div class="d-flexjustify-content-center">
			

			      <img class="img-fluid" src="../contenu/'.$Row['nom_filiere']."/".$Row['nom_af']."/".$Row['nom_module']."/".$Row['nom_element_module']."/".$row['nom_section']."/".$Row['nom_fichier'].'" alt="'.$Row['nom_fichier'].'">
			      </div>		      	
		
	
			      
			      <a class="btn  d-flex justify-content-center mt-2 col-md-12"  style="background-color:#b3ffcc;" href="../contenu/'.$Row['nom_filiere']."/".$Row['nom_af']."/".$Row['nom_module']."/".$Row['nom_element_module']."/".$row['nom_section']."/".$Row['nom_fichier'].'" alt="'.$Row['nom_fichier'].'" download>Telecharger
	
			</a>
			
			

	

			
			';
			
			
			echo '
			
            
			
               
           
			';
			

		}
		
		else if($FileType == "video"){

			echo '			<div class="embed-responsive embed-responsive-16by9">
            <video controls class="embed-responsive-item" src="'.'../contenu/'.$Row['nom_filiere']."/".$Row['nom_af']."/".$Row['nom_module']."/".$Row['nom_element_module']."/".$row['nom_section']."/".$Row['nom_fichier'].'"></video>
                </div>
			<br><hr>
			<a class="btn  d-flex justify-content-center mt-2 col-md-12"  style="background-color:#b3ffcc;" href="../contenu/'.$Row['nom_filiere']."/".$Row['nom_af']."/".$Row['nom_module']."/".$Row['nom_element_module']."/".$row['nom_section']."/".$Row['nom_fichier'].'" alt="'.$Row['nom_fichier'].'" download>
			
			Telecharger

			</a>';
			
		}
		else {
			echo '<a class="btn d-flex justify-content-center mt-2 col-md-12"  style="background-color:#b3ffcc;" href="../contenu/'.$Row['nom_filiere']."/".$Row['nom_af']."/".$Row['nom_module']."/".$Row['nom_element_module']."/".$row['nom_section']."/".$Row['nom_fichier'].'"       download>
			Télecharger
			</a>
			
			
			'
			;
		}
		echo '</div></div></div>';
		

		
		
		
	}
	

	
	
	
	echo '
	</div>';
	
	
	
	
	
	
	
}
?>
</div>
</div>
   
    
            </div>
            <footer id="footer" class="d-flex justify-content-center mt-auto py-4 bg-primary text-white-50 ">
                <div class="text-center">
                <small>Copyright &copy; Abdelghani & Saad</small>
                </div>
            </footer>
        </div>
	</body>
</html>
