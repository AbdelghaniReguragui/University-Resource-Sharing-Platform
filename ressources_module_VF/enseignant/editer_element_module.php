<?php
   include('session.php');
	$element_module_err = "";
	$id_element_module = "";
	$nom_element_module = "";
	
	
	if ( (isset($_POST['id_element_module']) &&  isset($_POST['nom_element_module']) ) || ( isset($_SESSION['id_element_module']) ) ){
		
		if(isset($_POST['id_element_module'])){
			$id_element_module = $_POST['id_element_module'];
			$nom_element_module = $_POST['nom_element_module'];
			$_SESSION['id_element_module'] = $id_element_module ;
		}
		else{
			$id_element_module = $_SESSION['id_element_module'];
			$nom_element_module = $_SESSION['nom_element_module'] ;
		}
	}
?>

<html class="h-100">
   
	<head>
		<title>Gestion de module : <?php echo $nom_element_module ;?>  </title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap/style.css" rel="stylesheet">
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
						<a class="nav-item nav-link" href="chef_filiere_page.php">Filiere</a>
						<a class="nav-item nav-link" href="editer_annee_formation.php">Annee formation</a>
						<a class="nav-item nav-link" href="editer_module.php">Module</a>
					</div>
					<div style="text-center; color:white">
						<center><span> Espace chef de filiere</span></center>
					</div>
					<div class="navbar-nav ml-auto">
                        <a class="nav-item nav-link bg-info mb-2 mr-sm-2 mb-sm-0" href = "profile_update.php"><?php echo $prenom_enseignant." ".$nom_enseignant;  ?></a>
						<a class="nav-item nav-link bg-danger rounded" href = "enseignant_logout.php">Deconnexion</a>
					</div>
				</div>
			</nav>
		<br>
		
		<h1><center><span class="badge badge-pill badge-primary mb-5"><?php echo $nom_element_module ; ?></span> </center></h1>
		
		
	<div class="container-fluid mb-4">	
		
		
		<?php

$sql = "select * from element_module LEFT JOIN enseignant ON (element_module.id_enseignant=enseignant.id_enseignant) where id_element_module = '$id_element_module'";
$result = mysqli_query($link,$sql);
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        
$count = mysqli_num_rows ($result);
        
	if($count == 1){
		if($row['id_enseignant']==null){
			$nom_enseignant="NULL";
            $prenom_enseignant="NULL";
            $email_enseignant="NULL";
			
		}
		else{
           $nom_enseignant=$row['nom_enseignant'];
           $prenom_enseignant=$row['prenom_enseignant'];
           $email_enseignant=$row['email']; 
			
		}
	}
?>
		
	<hr>
    <div class="d-flex justify-content-center  ">
        <div class="w-50 p-3">
            <table class="table border border-dark">
        
                <tbody class="thead-dark">
					<tr>
						<th colspan="2" class="col-6 text-center" scope="col">L'enseignant responsable sur cet element module</th>
					</tr>
                    <tr>
						<th class="col-1" scope="col">Nom</th>

						<td class="col-sm-3" scope="col"><?php echo $nom_enseignant; ?></td>
					</tr> 
					<tr>
						<th class="col-1" scope="col">Prénom</th>

						<td class="col-sm-3" scope="col"><?php echo $prenom_enseignant; ?></td>
                
					</tr>
					<tr>
						<th class="col-1" scope="col">Email</th>

						<td class="col-sm-3" scope="col"><?php echo $email_enseignant; ?></th>
   
   
					</tr>
				</tbody>
            </table>
            <br><br>
        </div>
    </div>	
	
		



<?php
		
		
	
	 echo  '   '.
        '<table class="table">
        
            <thead class="thead-dark">
            <tr>
            <th colspan="4" class="col-6 text-center">Liste des enseignants libres</th>
            </tr>
            <tr>
                <th class="col-sm-3" scope="col">'."Nom de l'enseignant".'</th>

                <th class="col-sm-3" scope="col">'."Prenom de l'enseignant".'</th>
                <th class="col-sm-4" scope="col">'."Email".'</th>

                <th class="col-sm-2" scope="col">Action</th>
   
            </tr>
            </thead>
            <tbody>
            </tbody>
</table>';
	
	


	$sql = "select * from enseignant ";
	$result = mysqli_query($link,$sql);
	while ($row = $result->fetch_assoc()) {
		
		
		echo '<form method="POST" action="affecter_enseignant.php">
		<input type="hidden" name="id_enseignant" value="'.$row['id_enseignant'].'">
		<input type="hidden" name="id_element_module" value="'.$id_element_module.'">
		<table class="table">
            <tbody>
				<tr>
					<td class="col-sm-3" scope="col">'.$row['nom_enseignant'].'</td>

					<td class="col-sm-3" scope="col">'.$row['prenom_enseignant'].'</td>
					<td class="col-sm-4" scope="col">'.$row['email'].'</td>

					<td class="col-sm-2" scope="col">
						<input type="submit" class="btn bg-success" name="affecter_enseignant" value="Affecter enseignant">
					</td>
   
				</tr>

			<tbody>
             </tbody>

		</table>
		</form>';
		
		
	}

?>


<hr>

			<br><br>
                </div>
                <footer id="footer" class="d-flex justify-content-center mt-auto py-4 bg-dark text-white-50 ">
                    <div class="text-center">
                        <small>Copyright &copy; Abdelghani & Saad</small>
                    </div>
                </footer>
        </div>
   </body>
   
</html>
