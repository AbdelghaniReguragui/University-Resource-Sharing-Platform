<?php
include('session.php');
	$element_module_err = "";
	$id_module = "";
	$nom_module = "";
	
	function function_alert($msg) {
		echo "<script type='text/javascript'>alert('$msg');window.location.href = 'editer_module.php';</script>";
		
	}
	
	if ( (isset($_POST['nom_element_module']))  && ( isset($_SESSION['id_module']) ) ){
		
		
		if(empty($_POST['nom_element_module'])){
			function_alert("Veuillez saisir le nom d'element module");
		}
		else{
			$nom_element_module = $_POST['nom_element_module'];
			$nom_element_module = mysqli_real_escape_string($link,$nom_element_module);
			$id_module = $_SESSION['id_module'] ;
			$sql = "select * from element_module where nom_element_module = '$nom_element_module' and id_af = '$id_module'";
			$result = mysqli_query($link,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);        
			$count = mysqli_num_rows ($result);
    
			if($count == 1){
				function_alert("Ce nom d'element module exist deja, veuilez saisir un autre nom");
			}
			else 	{
				$sql = "insert into element_module (id_module , nom_element_module) values ('$id_module' , '$nom_element_module')";
				if(mysqli_query($link,$sql)){
					echo $nom_element_module."  "." est ajoute ";
					$chemin="../contenu/".$_SESSION['nom_filiere']."/".$_SESSION['nom_af']."/".$_SESSION['nom_module']."/$nom_element_module";

                    if (!is_dir($chemin)){
						mkdir($chemin, 0700);
						function_alert("Element module ajouté");
					}
					else{
						function_alert("Element module ajouté, mais il y'a eu une erreur lorsque la création du dossier");
					}
					//header('location:editer_module.php');
				}
				else 
					function_alert(" une erreur s'est produite");
			}
		}
	}

?>






