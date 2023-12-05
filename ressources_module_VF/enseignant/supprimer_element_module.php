<?php
include('session.php');
	$id_element_module = "";
	
	if ( (isset($_POST['id_element_module'])) &&  isset($_SESSION['id_module']) ){
		
		$id_element_module = $_POST['id_element_module'];
		$id_module = $_SESSION['id_module'];
		
		$sql = "delete from element_module where id_module = '$id_module' and id_element_module = '$id_element_module'";
		if(mysqli_query($link,$sql)){
			header('location:editer_module.php');
		}
		
		else echo " une erreur s'est produite ";
	}

?>