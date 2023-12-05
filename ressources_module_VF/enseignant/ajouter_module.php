<?php
include('session.php');
	$module_err = "";
	$id_af = "";
	$nom_af = "";
	$nom_module_err = "";
	
	function function_alert($msg) {
		echo "<script type='text/javascript'>alert('$msg');window.location.href = 'editer_annee_formation.php';</script>";	
	}
	
	if ( isset($_POST['nom_module'])  && ( isset($_SESSION['id_af']) ) ){
		
		
		if(empty($_POST['nom_module'])){
			function_alert("Veuillez saisir le nom du module");
			//header('refresh:5;location:editer_annee_formation.php');
		}
			else{
			$nom_module = $_POST['nom_module'];
			$nom_module = mysqli_real_escape_string($link,$nom_module);
			$id_af = $_SESSION['id_af'] ;
			$nom_af = $_SESSION['nom_af'];
			$nom_af = mysqli_real_escape_string($link,$nom_af);
			$sql = "select * from module where nom_module = '$nom_module' and id_af = '$id_af'";
			$result = mysqli_query($link,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);        
			$count = mysqli_num_rows ($result);
    
			if($count == 1){
				sleep(5);
				function_alert("Ce nom de module exist deja, veuilez saisir un autre nom");
			}
			else 	{
				$sql = "insert into module (id_af , nom_module) values ('$id_af' , '$nom_module')";
				if(mysqli_query($link,$sql)){
					$chemin="../contenu/".$_SESSION['nom_filiere']."/".$_SESSION['nom_af']."/$nom_module";

                    if (!is_dir($chemin)){
						mkdir($chemin, 0700);
						function_alert("Module ajouté");
					}
					else{
						function_alert("Module ajouté, mais il y'a eu une erreur lorsque la création du dossier");
					}
				}
				else {
					function_alert(" une erreur s'est produite");
				}
			}
		}
	}
?>