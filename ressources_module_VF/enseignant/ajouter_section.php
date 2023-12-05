<?php
include('session.php');

$id_element_module = "";
$nom_section = ""; 

function function_alert($msg) {
		echo "<script type='text/javascript'>alert('$msg');window.location.href = 'editer_element_module_enseignant.php';</script>";
		
	}

if($_POST['nom_section'] && $_SESSION['id_em']){
	
	if(empty($_POST['nom_section'])){
			function_alert("Veuillez saisir le nom de section SVP");
	}
	else {
		
		$id_element_module = $_SESSION['id_em'];
		$nom_section = $_POST['nom_section'];
		$nom_section = mysqli_real_escape_string($link,$nom_section);
		$sql = "select * from section where nom_section = '$nom_section' and id_element_module = '$id_element_module'";
		$result = mysqli_query($link,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);        
			$count = mysqli_num_rows ($result);
    
			if($count == 1){
				function_alert("Cette section exist deja, vous devez changer le nom de la section que vous avez saisi");
			}
			else{
				$sql = "insert into section (nom_section,id_element_module) values ('$nom_section','$id_element_module')";
				if(mysqli_query($link,$sql)){
					$chemin="../contenu/".$_SESSION['nom_f']."/".$_SESSION['nom_annee']."/".$_SESSION['nom_mod']."/".$_SESSION['nom_em']."/$nom_section";

                    if (!is_dir($chemin)){
						mkdir($chemin, 0700);
						function_alert("Section cree avec succees");
					}
					else{
						function_alert("Folder already exists");
					}
				}
				else echo function_alert("Une erreur s\'est produite");
			}

	}
	
}

?>