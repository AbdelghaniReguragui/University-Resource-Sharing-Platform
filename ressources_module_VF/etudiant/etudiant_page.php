<?php
include('session.php');




?>


<html class="h-100">
   
   <head>
      <title><?php echo' Espace étudiant'; ?></title>
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
                    </div>
                    <div class="navbar-nav d-flex justify-content-center">
                        <span > Espace Etudiant</span>

                    </div>
                    <div class="navbar-nav ml-auto">
                        <a class="nav-item nav-link bg-info mb-2 mr-sm-2 mb-sm-0" href = "profile_update.php"><?php echo $etudiant_name; ?></a>
                        <a class="nav-item nav-link bg-danger rounded mb-2 mr-sm-2 mb-sm-0" href = "etudiant_logout.php">Deconnexion</a>
                    </div>
                </div>
            </nav>
            
            
             <div class="container-fluid " style="background-color:#e6f0ff;">
   <br>
   <br>
	  <h1><center><?php echo $annee_formation ; ?></center></h1>
  
	 

	  
	  
	  <div class="d-flex justify-content-center" >
            <div class="panel panel-default mt-4 col-md-10 mb-4 rounded h-100"  style="background-color:#99c2ff;">



<?php 
$sql = "select * from module  JOIN annee_formation ON module.id_af=annee_formation.id_af JOIN filiere ON filiere.id_filiere=annee_formation.id_filiere where annee_formation.id_af = '$id_af'";
$result = mysqli_query($link,$sql);
// echo mysqli_error($link);
// 	echo '<div class="container-fluid mt-4 col-md-11  bg-primary rounded" style="background-color:#cce0ff;" >';
while ($row = $result->fetch_assoc()) {
// echo mysqli_error($link);
    
    echo '<div class="d-flex justify-content-center" >
            <div class="panel panel-default mt-2 mb-2 col-md-11 rounded"  style="background-color:#99c2ff;">';
    echo '  <div class="panel-heading d-flex justify-content-center" >
                    
                </div>
                <div class="panel-body d-flex justify-content-center">
                <div class="card col-8 mt-4 col-md-12" >
            <div class="card-header text-center" style="background-color:#9ea4b2;">
                <h5><h2 class=" border-bottom text-dark">'.$row['nom_module'].'</h2></h5>
            </div>
            <div class="card-body">
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
