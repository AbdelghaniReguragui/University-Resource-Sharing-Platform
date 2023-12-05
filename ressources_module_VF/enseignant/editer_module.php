<?php
   include('session.php');
	$id_module = "";
	$nom_module = "";
	$element_module_err = "";
	
	
	function function_alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
	
	
	function rrmdir($dir) {
		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object) {
				if ($object != "." && $object != "..") {
				if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
				}
			}
			reset($objects);
			if(rmdir($dir))
				return true;
		}
	}
	
	
	if ( (isset($_POST['module']) &&  isset($_POST['nom_module']) ) || ( isset($_SESSION['id_module']) ) ){
		if(isset($_POST['module'])){
			$id_module = $_POST['module'];
			$nom_module = $_POST['nom_module'];
			$_SESSION['id_module'] = $id_module ;
		}
		else{
			$id_module = $_SESSION['id_module'];
			$nom_module = $_SESSION['nom_module'] ;
		}
		
		if(isset($_POST['id_element_module'])){
			$element_module = $_POST['id_element_module'];
			//modification d'element module
			if ($_POST['handle'] == 1){
				if(!empty($_POST['nv_nom'])){
					$old_name = $_POST['old_name'];
					$name_element_module = $_POST['nv_nom'];
					$name_element_module = mysqli_real_escape_string($link,$name_element_module);
					$sql = "select * from element_module where nom_element_module = '$name_element_module'";
					$result = mysqli_query($link,$sql);
					$row = mysqli_fetch_array($result,MYSQLI_ASSOC);        
					$count = mysqli_num_rows ($result);
		
					if($count == 1){
						function_alert("Ce element de module existe deja, veuillez saisir un autre nom svp");
					}
					else {
						$sql = "update element_module set nom_element_module = '$name_element_module' where id_element_module = '$element_module'";
						if(mysqli_query($link,$sql)){
							$olddir ="../contenu/".$_SESSION['nom_filiere']."/".$_SESSION['nom_af']."/".$_SESSION['nom_module']."/$old_name";
							$newdir ="../contenu/".$_SESSION['nom_filiere']."/".$_SESSION['nom_af']."/".$_SESSION['nom_module']."/$name_element_module";
							if(rename($olddir,$newdir)){
								function_alert("Element module est modifie avec succes");
							}
							else{
								function_alert("Element module est modifie, mais il y'a eu ume erreur lorsque la modification de dossier");
							}
							//header('location:editer_module.php');
						}
						else function_alert("Une erreur s'est produite");
					}
				}
			}
			//suppression d'element module
			else if($_POST['handle'] == 2){
				if(!empty($_POST['id_element_module'])){
					$nom_em = $_POST['nom_element_module'];
					$sql = "select * from element_module where id_element_module = '$element_module'";
					$result = mysqli_query($link,$sql);
					$row = mysqli_fetch_array($result,MYSQLI_ASSOC);        
					$count = mysqli_num_rows ($result);
					if($count == 1){
						$sql = "delete from element_module where id_element_module = '$element_module' ";
						if(mysqli_query($link,$sql)){
							function_alert("Module supprime avec succes");
							$dir ="../contenu/".$_SESSION['nom_filiere']."/".$_SESSION['nom_af']."/".$_SESSION['nom_module']."/$nom_em";
							if (rrmdir($dir)) { // si le paramètre est un dossier
							}
							else 
								function_alert("Une erreur s'est produite lorsque la suppression de dossier");
							//header('location:editer_module.php');
						}
						
					}
					else {
						function_alert("Ce module n'existe pas");
					}
			}
		}
	}
	}

?>


<html>
   
   <head>
	  <title>Gestion de module : <?php echo $nom_module ;?>  </title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap/style.css" rel="stylesheet">
	  <style>
		.update-form-popup,.delete-form-popup {
			display : none ;
		}
	  </style>
   </head>
   
   <body class="h-100">
   
            <script>
function openUpdateForm(id) {
    var form = document.getElementsByClassName('delete-form-popup');

    for (var i = 0; i < form.length; i ++) {
        form[i].style.display = 'none';
    }
    form = document.getElementsByClassName('update-form-popup');

    for (var i = 0; i < form.length; i ++) {
        if(form[i].id!=arguments[0]){
            form[i].style.display = 'none';
        }
    }
//  document.getElementsByClassName('delete-form-popup').style.display="none";
  document.getElementById(arguments[0]).style.display = "block";
}

function closeUpdateForm(id) {
  document.getElementById(arguments[0]).style.display = "none";
}

function openDeleteForm(id) {
// document.getElementsByClassName('form-popup').style.display="block";
    var form = document.getElementsByClassName('update-form-popup');

    for (var i = 0; i < form.length; i ++) {
        form[i].style.display = 'none';
    }
    form = document.getElementsByClassName('delete-form-popup');

    for (var i = 0; i < form.length; i ++) {
        if(form[i].id!=arguments[0]){
            form[i].style.display = 'none';
        }
    }
//  document.getElementsByClassName('delete-form-popup').style.display="none";
  document.getElementById(arguments[0]).style.display = "block";
}

function closeDeleteForm(id) {
  document.getElementById(arguments[0]).style.display = "none";
}
</script>
   
	
	
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
				</div>
				<div style="text-center; color:white">
					<center><span> Espace Enseignant</span></center>
				</div>
				<div class="navbar-nav ml-auto">
					<span class="nav-item nav-link"><?php echo $prenom_enseignant." ".$nom_enseignant; ?></span>
					<a class="nav-item nav-link bg-danger rounded" href = "admin_logout.php">Deconnexion</a>
				</div>
			</div>
		</nav>
		<br>
		
		
		
		
		<div class="container-fluid">
			<div class="container-fluid bg-light">
				<br>
				<h1><center><span class="badge badge-pill badge-primary mb-5"><?php echo $nom_module ; ?></span> </center></h1>
				<br>
				<hr>
				<div class="d-flex justify-content-center bg-light" >
					<h2 class="  border-bottom">Ajouter un element module</h2>
				</div>
				<form action="ajouter_element_module.php" method="POST">
					<div class="">
						<input type="text" name="nom_element_module" class="form-control" placeholder="nom element module" >
						<span class="help-block"><?php echo $element_module_err; ?></span>
					</div>
					<br>
					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Submit">
						<input type="reset" class="btn btn-default" value="Reset">
					</div>
				</form>
			</div>
					
	

<?php

echo "<h1><center> Les elements modules </center></h1> ";
 echo  '   '.
    '<table class="table">
        <thead class="thead-dark">
            <tr>
                <th class="col-sm-2" scope="col">Nom element module</th>
				<th class="col-sm-2" scope="col">Enseignant </th>
                <th class="col-sm-2" scope="col">Action</th>
   
            </tr>
        </thead>
        <tbody>
        </tbody>
	</table>';

$sql = "select * from element_module left join enseignant on element_module.id_enseignant = enseignant.id_enseignant where id_module = '$id_module'";
$result = mysqli_query($link,$sql);
while ($row = $result->fetch_assoc()) {
	/////////////// affichage des elements modules  \\\\\\\\\\\\\\\\\\\\\\\\
	
	//verification si l'element module contient un enseignant ou pas
	$name_enseignant = $row['nom_enseignant'];
	if (empty($name_enseignant)){
		$name_enseignant = " enseignant non affecte ";
	}
	

   echo '<form action="editer_element_module.php"  class="form-container" style="margin: auto "  method="post">'.' 
        
	<table class="table">
		<tbody>
			<tr>
			<td class="col-sm-2">'."" . $row['nom_element_module'] ."</td>".
			'<td class="col-sm-2">'."" . $name_enseignant ."</td>".
			'<td class="col-sm-2">'."" .
	   	
	'<div class="btn-group-sm btn-group-vertical">
	
	
    <input value="modifier" type="button" class="btn bg-warning" onclick="openUpdateForm('."'".$row['id_element_module']."'".')">
    <input value="supprimer" type="button" class="btn bg-danger" onclick="openDeleteForm('."'delete".$row['id_element_module']."'".')">
	<input class="btn bg-secondary"  type="submit" name="acceder_element_module" value="affecter enseignant a ce element module">
	</div>
	</td>
	</tr>
		</tbody>
	</table>
	
	<input type="hidden" name="id_element_module" value="'.$row['id_element_module'].'">
	<input type="hidden" name="nom_element_module" value="'.$row['nom_element_module'].'">
	
	</form>';
	
	//modifier element module
	echo '
	<div class="update-form-popup bg-warning" id="'.$row['id_element_module'].'">
	<form action="editer_module.php"  class="form-container" method="post">
    <h2>Modifier element module</h2>

    <label ><b>Nouveau nom element module </b></label>
    <input type="text" value="'.$row['nom_element_module'].'" placeholder="nouveau nom" name="nv_nom" required>
    
    
    <input type="hidden" name="handle" value="1" >
    <input type="hidden" name="id_element_module" value="'.$row['id_element_module'].'" >
	<input type="hidden" name="old_name" value="'.$row['nom_element_module'].'" >



    <button type="submit" class="btn bg-danger">Modifier</button>
    <button type="button" class="btn bg-success" onclick="closeUpdateForm('."'".$row['id_element_module']."'".')">Annuler</button>
	</form>
	</div>';
	
	
	
	
	//supprimer element module 
	echo '
	<div class="delete-form-popup"  id="delete'.$row['id_element_module'].'">
		<form action="editer_module.php"  class="form-container" method="post">
		<h2>Supprimer element module</h2>

    


    
		<input type="hidden" name="handle" value="2" >
		<input type="hidden" name="id_element_module" value="'.$row['id_element_module'].'" >
		<input type="hidden" name="nom_element_module" value="'.$row['nom_element_module'].'" >



		<button type="submit" class="btn bg-danger border border-primary">Confirmer suppression</button>
		<button type="button" class="btn bg-success border border-primary" onclick="closeDeleteForm('."'delete".$row['id_element_module']."'".')">Annuler</button>
		</form>
	</div>';
}
?>

		</div>
		<footer id="footer" class="d-flex justify-content-center mt-auto py-4 bg-dark text-white-50 ">
			<div class="text-center">
				<small>Copyright &copy; Abdelghani & Saad</small>
			</div>
		</footer>
	</div>
       
   </body>
   
</html>