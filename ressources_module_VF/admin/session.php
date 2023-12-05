<?php
   include('config.php');
   session_start();
   if(empty($_SESSION['admin'])) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: deconnexion.php');
  exit();
}
   
   $user_check = $_SESSION['admin'];
   
   $ses_sql = mysqli_query($link,"select * from admin where email = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['email'];
   $admin_name=$row['prenom']." ".$row['nom'];
   
   if(!isset($_SESSION['admin'])){
      header("location:admin_login.php");
      die();
   }
?>
