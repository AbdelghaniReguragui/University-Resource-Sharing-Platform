<?php
include('session.php');
	$id_module = "";
	
	if ( (isset($_POST['id_module'])) &&  isset($_SESSION['id_af']) ){
		
		$id_module = $_POST['id_module'];
		$id_af = $_SESSION['id_af'];
		
		$sql = "delete from module where id_module = '$id_module' and id_af = '$id_af'";
		if(mysqli_query($link,$sql)){
			header('location:editer_annee_formation.php');
		}
		
		else echo " une erreur s'est produite ";
	}
	else echo " session or post ";

?>