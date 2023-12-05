<?php
   include('session.php');
	$id_af = "";
	$nom_af = "";
	$module_err = "";
	
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
	if ( (isset($_POST['id_af']) &&  isset($_POST['nom_af']) ) || ( isset($_SESSION['id_af']) ) ){
		if(isset($_POST['id_af'])){
			$id_af = $_POST['id_af'];
			$nom_af = $_POST['nom_af'];
			$_SESSION['id_af'] = $id_af ;
		}
		else{
			$id_af = $_SESSION['id_af'];
			$nom_af = $_SESSION['nom_af'] ;
		}
		if($_SERVER['REQUEST_METHOD']=='POST'){
		if(isset($_POST['id_module'])){
			$module = $_POST['id_module'];
			//modification de module
			if ($_POST['handle'] == 1){
				if(!empty($_POST['nv_nom'])){
					$oldname_module = $_POST['oldname_module'];
					$name_module = $_POST['nv_nom'];
					$name_module = mysqli_real_escape_string($link,$name_module);
					$sql = "select * from module where nom_module = '$name_module'";
					$result = mysqli_query($link,$sql);
					$row = mysqli_fetch_array($result,MYSQLI_ASSOC);        
					$count = mysqli_num_rows ($result);
		
					if($count == 1){
						function_alert("ce module existe deja");
					}
					else {
						$sql = "update module set nom_module = '$name_module' where id_module = '$module'";
						if(mysqli_query($link,$sql)){
							$olddir ="../contenu/".$_SESSION['nom_filiere']."/".$_SESSION['nom_af']."/$oldname_module";
							$newdir ="../contenu/".$_SESSION['nom_filiere']."/".$_SESSION['nom_af']."/$name_module";
							if(rename($olddir,$newdir))
								function_alert("le nom du module est modifie");
							//header('location:editer_annee_formation.php');
						}
						else function_alert("une erreur s'est produite");
					}
				}
			}
			//suppression de module
			else if($_POST['handle'] == 2){
				if(!empty($_POST['id_module'])){
					$nom_module = $_POST['nom_module'];
					$sql = "select * from module where id_module = '$module'";
					$result = mysqli_query($link,$sql);
					$row = mysqli_fetch_array($result,MYSQLI_ASSOC);        
					$count = mysqli_num_rows ($result);
					if($count == 1){
						$sql = "delete from module where id_module = '$module' ";
						if(mysqli_query($link,$sql)){
							$dir="../contenu/".$_SESSION['nom_filiere']."/".$_SESSION['nom_af']."/$nom_module";
							if(rrmdir($dir)){
								function_alert("module supprime avec succes");
							}
							else 
								function_alert("le dossier du module n'est pas supprime");
							//header('location:editer_annee_formation.php');
						}
					}
					else {
						function_alert("ce module n'existe pas");
					}
				}
			}
		}
		}
	}
	
	
?>

<html>
   
   <head>
	  <title>Gestion d'annee formation : <?php echo $nom_af ;?>  </title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap/style.css" rel="stylesheet">
	  <style>
		.update-form-popup,.delete-form-popup {
			display : none ;
		}
	  </style>
	<script> 
	function doSomething() {
    alert('Form submitted!');
    return false;
	}
	</script>
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

            
            
		<div class="container-fluid">
	
			<div class="container-fluid bg-light">
				<br>
				<h1><center><span class="badge badge-pill badge-primary mb-5"><?php echo $nom_af ; ?></span> </center></h1>
				<br>
				<hr>
	
				<div class="d-flex justify-content-center bg-light" >
					<h2 class="  border-bottom">Ajouter un module</h2>
				</div>
				<form action="ajouter_module.php" method="POST">
					<div class="">
				
						<input type="text" name="nom_module" class="form-control" placeholder="nom module">
						<span class="help-block"><?php echo $module_err; ?></span>
					</div>
					<br>
					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Submit">
						<input type="reset" class="btn btn-default" value="Reset">
					</div>
				</form>
			</div>
		
	


<?php


echo "<h1><center> Les modules </center></h1> ";
 echo  '   '.
    '<table class="table">
        <thead class="thead-dark">
            <tr>
                <th class="col-sm-2" scope="col">Nom module</th>
                <th class="col-sm-2" scope="col">Action</th>
   
            </tr>
        </thead>
        <tbody>
        </tbody>
	</table>';


$sql = "select * from module where id_af = '$id_af'";
$result = mysqli_query($link,$sql);
while ($row = $result->fetch_assoc()) {
	//affichage des modules de l'annee formation choisie
    echo '<form action="editer_module.php"  class="form-container" style="margin: auto "  method="post">'.' 
        
	<table class="table">
		<tbody>
			<tr>
			<td class="col-sm-2">'."" . $row['nom_module'] ."</td>".
			'<td class="col-sm-2">'."" .
	   	
	'<div class="btn-group-sm btn-group-vertical">

	<input value="modifier" type="button" class="btn bg-warning" onclick="openUpdateForm('."'".$row['id_module']."'".')">
    <input value="supprimer" type="button" class="btn bg-danger" onclick="openDeleteForm('."'delete".$row['id_module']."'".')">
	<input class="btn bg-secondary"  type="submit" name="acceder_module" value="acceder au module">
	</div>
	</td>
	</tr>
		</tbody>
	</table>
	
	<input type="hidden" name="module" value="'.$row['id_module'].'">
	<input type="hidden" name="nom_module" value="'.$row['nom_module'].'">'.'
	</form>';
	
	//modification d'un module
	echo '
	<div class="update-form-popup bg-warning" id="'.$row['id_module'].'">
	<form action="editer_annee_formation.php"  class="form-container" method="post">
    <h2>Modifier module</h2>

        <label ><b>Nom module </b></label>
    <input type="text" value="'.$row['nom_module'].'" placeholder="nouveau nom" name="nv_nom" required>
    

    <input type="hidden" name="handle" value="1" >
    <input type="hidden" name="id_module" value="'.$row['id_module'].'" >
	<input type="hidden" name="oldname_module" value="'.$row['nom_module'].'" >



    <button type="submit" class="btn bg-danger">Modifier</button>
    <button type="button" class="btn bg-success" onclick="closeUpdateForm('."'".$row['id_module']."'".')">Annuler</button>
	</form>
	</div>';
	
	
	
	
	//supprimer module 
	echo '
	<div class="delete-form-popup" id="delete'.$row['id_module'].'">
		<form action="editer_annee_formation.php"  class="form-container" method="post">
		<div class="d-flex justify-content-center ">

		<input type="hidden" name="handle" value="2" >
		<input type="hidden" name="id_module" value="'.$row['id_module'].'" >
		<input type="hidden" name="nom_module" value="'.$row['nom_module'].'" >



		<button type="submit" class="btn bg-danger border border-primary">Confirmer suppression</button>
		<button type="button" class="btn bg-success border border-primary" onclick="closeDeleteForm('."'delete".$row['id_module']."'".')">Annuler</button>
		</div>
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
