<?php

$servername = "localhost";
$username = "root";
$password = "";
$name = "ressource_module";

$link = mysqli_connect($servername,$username,$password,$name);

if($link == false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>
