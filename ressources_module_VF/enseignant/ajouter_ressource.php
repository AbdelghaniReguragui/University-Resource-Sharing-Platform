<?php

include('session.php');

function function_alert($msg) {
		echo "<script type='text/javascript'>alert('$msg');window.location.href = 'editer_element_module_enseignant.php';</script>";
		
	}

function is_valid_name($file) {
  return preg_match('/^([-\.\w]+)$/', $file) > 0;
}

$id_section = "";
$section = "";
$chemin="";
$type = "";
    if(!isset($_FILES["fileToUpload"]))header('location:editer_element_module_enseignant.php');
$target_file = $chemin. basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$id_section = $_POST['id_section'];
	$section = $_POST['section'];
	$chemin="../contenu/".$_SESSION['nom_f']."/".$_SESSION['nom_annee']."/".$_SESSION['nom_mod']."/".$_SESSION['nom_em']."/$section/";
	$target_file = $chemin. basename($_FILES["fileToUpload"]["name"]);
        $nom_ressource=mysqli_real_escape_string($link,$_POST['nom_ressource']);
        $desc=mysqli_real_escape_string($link,$_POST['description']);
    
        
		$query = "SELECT * FROM ressource WHERE ressource.nom_ressource = "."'$nom_ressource' AND id_section=".$_POST['id_section'];
		$result = mysqli_query($link,$query);
		echo mysqli_error($link);
		$rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
      
		if($count == 1) {
		function_alert("OPERATION ECHOUEE");
		$uploadOk=0;
		
		}
if (!is_valid_name($target_file)) {
  $uploadOK=0;
}
// Check if file already exists
if (file_exists($target_file)) {
  function_alert("Sorry, file already exists.");
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  function_alert("Sorry, your file is too large.");
  $uploadOk = 0;
}

// Allow certain file formats
  if($FileType == "jpg" || $FileType == "png" || $FileType == "jpeg" || $FileType == "gif"  ){
	  $type="image";
  }
  else if($FileType == "mp4" || $FileType == "ogg" || $FileType == "webm"){
	$type="video";
  }
  else 
	  $type = "autre";


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  function_alert("Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
} else {
	$filename = $_FILES["fileToUpload"]["name"];
	$sql = "insert into ressource (nom_fichier,id_section,chemin,type, description, nom_ressource)values('$filename','$id_section','$chemin','$type','".$desc."','". $nom_ressource ."')";
	if(mysqli_query($link,$sql)){
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$msg = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			function_alert($msg);
			//header('location:editer_element_module_enseignant.php');
		} else {
			function_alert("Sorry, there was an error uploading your file.");
		}
	}
}
}

?>
