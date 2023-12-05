<?php
include('session.php');
define('MAX_SIZE', 100000);
$id_element_module = "";
$nom_element_module = "";
function function_alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

if (isset($_POST['id_element_module']) || isset($_SESSION['id_em'])){
	if(isset($_POST['id_element_module'])){
			$sql = "select * from element_module LEFT JOIN module ON element_module.id_module = module.id_module LEFT JOIN annee_formation ON module.id_af=annee_formation.id_af LEFT JOIN filiere ON filiere.id_filiere=annee_formation.id_filiere WHERE id_element_module=".$_POST['id_element_module'];
        $result = mysqli_query($link,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);  
		

		
	}
	else{
        $sql = "select * from element_module LEFT JOIN module ON element_module.id_module = module.id_module LEFT JOIN annee_formation ON module.id_af=annee_formation.id_af LEFT JOIN filiere ON filiere.id_filiere=annee_formation.id_filiere WHERE id_element_module=".$_SESSION['id_em'];
        $result = mysqli_query($link,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC); 
		;
	}
			$_SESSION['nom_f']=$row['nom_filiere'];
		$_SESSION['nom_annee']=$row['nom_af'];
		$_SESSION['nom_mod']=$row['nom_module'];
		$_SESSION['nom_em']=$row['nom_element_module'];
		$id_element_module =  $row['id_element_module'];
		$nom_element_module = $_SESSION['nom_em'];
		$_SESSION['id_em'] = $id_element_module ;
	}
	
	
	
	if(isset($_POST['handle'])){
			//modification de la section
			if ($_POST['handle'] == 1){
				if(!empty($_POST['nv_nom'])){
    
					$oldname_section = $_POST['oldname_section'];
					$nom_section = $_POST['nv_nom'];
					$nom_section = mysqli_real_escape_string($link,$nom_section);
					$sql = "select * from section where nom_section = '$nom_section' AND id_element_module=".$_POST['id_element_module'];
					$result = mysqli_query($link,$sql);
					$row = mysqli_fetch_array($result,MYSQLI_ASSOC);        
					$count = mysqli_num_rows ($result);
		
					if($count == 1){
						function_alert(" cette section existe deja ");
						$section_err = " cette section existe deja ";
					}
					else {
						$sql = "update section set nom_section = '$nom_section' where id_section =".$_POST['id_section'];
						if(mysqli_query($link,$sql)){
							$olddir ="../contenu/".$_SESSION['nom_f']."/".$_SESSION['nom_annee']."/".$_SESSION['nom_mod']."/".$_SESSION['nom_em']."/$oldname_section";
							$newdir ="../contenu/".$_SESSION['nom_f']."/".$_SESSION['nom_annee']."/".$_SESSION['nom_mod']."/".$_SESSION['nom_em']."/$nom_section";
							rename($olddir,$newdir);
							function_alert(" section modifiée");
							header('location:editer_element_module_enseignant.php');
						}
					}
				}
			}
			//suppression de la section
			else if($_POST['handle'] == 2){
				if(!empty($_POST['id_section'])){
					$sql = "select * from section where id_section =".$_POST['id_section'];
					$result = mysqli_query($link,$sql);
					$row = mysqli_fetch_array($result,MYSQLI_ASSOC);        
					$count = mysqli_num_rows ($result);
					if($count == 1){
						
						
						//suppression de la section de la bdd
						$sql = "delete from section where id_section =".$_POST['id_section'];
						if(mysqli_query($link,$sql)){
							
								
							//suppression le dossier section avec tout ce qu'il contient
							$nom_section = $_POST['nom_section'];
							$dir ="../contenu/".$_SESSION['nom_f']."/".$_SESSION['nom_annee']."/".$_SESSION['nom_mod']."/".$_SESSION['nom_em']."/$nom_section";
                            
							if (is_dir($dir)) { // si le paramètre est un dossier
								$objects = scandir($dir); // on scan le dossier pour récupérer ses objets
								foreach ($objects as $object) { // pour chaque objet
									if ($object != "." && $object != "..") { // si l'objet n'est pas . ou ..
										if (filetype($dir."/".$object) == "dir") rmdir($dir."/".$object);
										else unlink($dir."/".$object); // on supprime l'objet
									}	
								}
								reset($objects); // on remet à 0 les objets
								rmdir($dir); // on supprime le dossier
							}
							function_alert(" suppression effectuée ");
							//header('location:editer_element_module_enseignant.php');
						}
						else 
							function_alert("  section non supprime ");
					}
					else {
						function_alert(" cette section n'existe pas ");
					}
				}
				else 
					function_alert(" Une erreur est survenue ");
			}
			
				else if($_POST['handle'] == 7){
		
		$id_ressource = $_POST['id_ressource'] ;
		$nom_fichier = $_POST['nom_fichier'] ;
		$nom_section = $_POST['nom_section'] ;
		
		$sql = "select * from ressource LEFT JOIN section ON ressource.id_section=section.id_section LEFT JOIN element_module ON section.id_element_module = element_module.id_element_module LEFT JOIN module ON element_module.id_module = module.id_module LEFT JOIN annee_formation ON module.id_af=annee_formation.id_af LEFT JOIN filiere ON filiere.id_filiere=annee_formation.id_filiere where id_ressource = '$id_ressource'";
		$result = mysqli_query($link,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);        
		$count = mysqli_num_rows ($result);
// 		echo "  nom section  est ".$nom_section ;
		if($count == 1){
// 			echo  "  ressource exists  "; 
			$sql = "delete from ressource where id_ressource = '$id_ressource'";
			if(mysqli_query($link,$sql)){
				function_alert(" ressource supprimée ");
				//supprimer la ressource
								$objet ='../contenu/'.$row['nom_filiere']."/".$row['nom_af']."/".$row['nom_module']."/".$row['nom_element_module']."/".$row['nom_section']."/".$row['nom_fichier']; 
				unlink($objet);
			}
			else function_alert(" Erreur suppression fichier ");
			
		}
		else function_alert("Errur");
	}
		}
	

	else echo "   ";
	
	


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
                <a class="navbar-brand" href="enseignant_page.php">Accueil</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                    <div class="navbar-nav mr-auto">    
                    </div>
                    <div style="text-center; color:white">
                        <center><span> Espace Enseignant</span></center>
                    </div>
                    <div class="navbar-nav ml-auto">
                        <a class="nav-item nav-link bg-info mb-2 mr-sm-2 mb-sm-0" href = "profile_update.php"><?php echo $prenom_enseignant." ".$nom_enseignant;  ?></a>
                        <a class="nav-item nav-link bg-danger rounded" href = "enseignant_logout.php">Deconnexion</a>
                    </div>
                </div>
            </nav>
            
            
             <div class="container-fluid " style="background-color:#e6f0ff;">
   <br>
   <br>
	  <h1><center><?php echo $nom_element_module ; ?></center></h1>
  
	 
	  <br>
	  <br>
        <div class="d-flex justify-content-center" >
            <div class="panel panel-default mt-4 col-md-6 rounded"  style="background-color:#99c2ff;">

                <div class="panel-heading d-flex justify-content-center" >
                    <h2 class=" border-bottom text-dark">Ajouter une section</h2>
                </div>
                <div class="panel-body d-flex justify-content-center">
                    <form action="ajouter_section.php" method="post" class="form-inline">
                        <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                            <label class="control-label mb-2 mr-sm-2 mb-sm-0">Nom de la section</label>
                            <input type="text" name="nom_section" class="form-control" placeholder="section" required >
                        </div>    
                        <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                            <input type="submit" class="btn btn-primary"  value="Ajouter">
                            <input type="hidden" name="handle" value="0">
                        </div>
                
                    </form>
                </div>
            </div>
        </div>
	  
	  
	  
	  




<?php 
$sql = "select * from section LEFT JOIN element_module ON section.id_element_module = element_module.id_element_module LEFT JOIN module ON element_module.id_module = module.id_module LEFT JOIN annee_formation ON module.id_af=annee_formation.id_af LEFT JOIN filiere ON filiere.id_filiere=annee_formation.id_filiere where section.id_element_module = '$id_element_module'";
$result = mysqli_query($link,$sql);
echo mysqli_error($link);

while ($row = $result->fetch_assoc()) {
	
	echo '<div class="container-fluid mt-4 col-md-11  rounded" style="background-color:#cce0ff;" ><div class="d-flex justify-content-center"><h1><center><span class="badge badge-pill mt-5" style="background-color:#f5f3f2;">'.$row['nom_section'].'</span> </center></h1></div><form method="POST" action="">
	<input type="hidden" name="id_section" value="'.$row['id_section'].'">
	<div class="d-flex justify-content-center"><input value="modifier" type="button" class="btn-primary rounded mb-2 mr-sm-2" onclick="openUpdateForm('."'".$row['id_section']."'".')">
    <input value="supprimer" type="button" class="btn bg-danger mb-2 mr-sm-2" onclick="openDeleteForm('."'delete".$row['id_section']."'".')"></div>
	</form>';
	
	
	//suppression et modification de section 
	
	//modifier section
	echo '
	<div class="update-form-popup" id="'.$row['id_section'].'">
	<form action="editer_element_module_enseignant.php"  class="form-container" method="post">
    <h2>Modifier section</h2>

    <label ><b>Nom section </b></label>
    <input type="text" value="'.$row['nom_section'].'" placeholder="nouveau nom" name="nv_nom" required>
    
	
	<!-- le programme envoi la valeur de handle pour preciser l operation qui va executer, la il a envoye la valeur 1 
	qui a une relation avec la modification et puis il envoi l id de la section -->
	
    <input type="hidden" name="handle" value="1" >
    <input type="hidden" name="id_section" value="'.$row['id_section'].'" >
	<input type="hidden" name="oldname_section" value="'.$row['nom_section'].'" >
	<input type="hidden" name="id_element_module" value="'.$row['id_element_module'].'" >


    <button type="submit" class="btn">Modifier</button>
    <button type="button" class="btn cancel" onclick="closeUpdateForm('."'".$row['id_section']."'".')">Annuler</button>
	</form>
	</div>';
	
	//supprimer section 
	echo '
	<div class="delete-form-popup" id="delete'.$row['id_section'].'">
		<form action="editer_element_module_enseignant.php"  class="form-container" method="post">
		<h2>Supprimer section</h2>

    
		<!-- le programme envoi la valeur de handle pour preciser l operation qui va executer, la il a envoye la valeur 2 
		qui a une relation avec la suppression de la section, et puis il envoi l id de la section -->
    
		<input type="hidden" name="handle" value="2" >
		<input type="hidden" name="id_section" value="'.$row['id_section'].'" >
		<input type="hidden" name="nom_section" value="'.$row['nom_section'].'" >



		<button type="submit" class="btn">Confirmer suppression</button>
		<button type="button" class="btn cancel" onclick="closeDeleteForm('."'delete".$row['id_section']."'".')">Annuler</button>
		</form>
	</div><br><hr>';
	
	
	
	//affichage de ressource
	$id_section = $row['id_section'];
	$sql = "select * from ressource LEFT JOIN section ON ressource.id_section=section.id_section LEFT JOIN element_module ON section.id_element_module = element_module.id_element_module LEFT JOIN module ON element_module.id_module = module.id_module LEFT JOIN annee_formation ON module.id_af=annee_formation.id_af LEFT JOIN filiere ON filiere.id_filiere=annee_formation.id_filiere where section.id_section = '$id_section'"; 
	$Result = mysqli_query($link,$sql);
	while ($Row = $Result->fetch_assoc()) {
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
			<div class="d-flex justify-content-center">
			

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
            <video controls class="embed-responsive-item" src="../contenu/'.$Row['nom_filiere']."/".$Row['nom_af']."/".$Row['nom_module']."/".$Row['nom_element_module']."/".$row['nom_section']."/".$Row['nom_fichier'].'"></video>
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
		
		echo '	<form action="editer_element_module_enseignant.php" class="form-container" method="post">
		
		<!-- l envoie du nom et id ressource --> 
		<input type="hidden" value="'.$Row['id_ressource'].'" name="id_ressource">
		<input type="hidden" value="'.$Row['nom_fichier'].'" name="nom_fichier">
		<input type="hidden" value="'.$row['nom_section'].'" name="nom_section">
		<button type="button" class="col-12 btn bg-danger mt-2 col-md-12" onclick="openDeleteForm('."'deleter".$Row['id_ressource']."'".')">supprimer la ressource</button>
		</form>
		
		
		<!-- suppression de la ressource -->
		<div class="delete-form-popup" id="deleter'.$Row['id_ressource'].'">
		<form action="editer_element_module_enseignant.php"  class="form-container" method="post">
		<h2>Supprimer section</h2>

    
		<!-- le programme envoi la valeur de handle pour preciser l operation qui va executer, la il a envoye la valeur 2 
		qui a une relation avec la suppression de la section, et puis il envoi l id de la section -->
    
		<input type="hidden" name="handle" value="7" >
		<input type="hidden" value="'.$Row['id_ressource'].'" name="id_ressource">
		<input type="hidden" value="'.$Row['nom_fichier'].'" name="nom_fichier">
		<input type="hidden" value="'.$row['nom_section'].'" name="nom_section">



		<button type="submit" class="btn">Confirmer suppression</button>
		<button type="button" class="btn cancel" onclick="closeDeleteForm('."'deleter".$Row['id_ressource']."'".')">Annuler</button>
		</form>
	</div>
                </div>
                </div>
                </form>';
		
		
		
		
	}
	
	echo '

	<div class="container-fluid mt-2 mb-4 col-md-12 border">
		<div class="d-flex justify-content-center"><h5>Ajouter une ressource</h5>
	</div>
	
	<form action="ajouter_ressource.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <input type="text" class="form-control" name="nom_ressource" placeholder="nom de la ressource" required>
  </div>
  <div class="form-group">
    <textarea class="form-control"name="description" placeholder="description" rows="3"></textarea>
  </div>
  <div class="form-group">
  	<input type="file" name="fileToUpload" id="fileToUpload" required>
    </div>
    <input type="hidden" name="section" value="'.$row['nom_section'].'">
	<input type="hidden" name="id_section" value="'.$row['id_section'].'">
    <div class="form-group">

	<input type="submit" class="btn-primary rounded" value="Importer" name="submit">
	</div>

</form>
</div>
	
	
	
	
	
	';
	
	
	
	echo '
	</div>';
	
	
	
	
	
	
	
}
?>
            </div>
            <footer id="footer" class="d-flex justify-content-center mt-auto py-4 bg-primary text-white-50 ">
                <div class="text-center">
                <small>Copyright &copy; Abdelghani & Saad</small>
                </div>
            </footer>
        </div>
	</body>
</html>
