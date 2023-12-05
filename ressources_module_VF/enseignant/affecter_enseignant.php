<?php

include('session.php');
$id_element_module = "";

function function_alert($msg) {
		echo "<script type='text/javascript'>alert('$msg');window.location.href = 'editer_element_module.php';</script>";
		
	}
if( isset($_SESSION['id_element_module']) ){
	$id_element_module = $_SESSION['id_element_module'];
}
if ( (isset($_POST['id_enseignant']) )){

	$element_module = $_SESSION['id_element_module'];
	$enseignant = $_POST['id_enseignant'];
	$sql = "update element_module set id_enseignant = '$enseignant'  where id_element_module = '$id_element_module'";
	if(mysqli_query($link,$sql)){
		function_alert("L\'enseignant est affecte");
		//header('location:editer_element_module.php');
	}
}
?>