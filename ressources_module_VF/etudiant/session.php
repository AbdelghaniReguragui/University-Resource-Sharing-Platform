<?php
   include('config.php');
   session_start();
   if(empty($_SESSION['etudiant'])) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: deconnexion.php');
  exit();
}
   
   $user_check = $_SESSION['etudiant'];
   
   $ses_sql = mysqli_query($link,"select * from etudiant LEFT JOIN annee_formation ON annee_formation.id_af=etudiant.annee_formation LEFT JOIN filiere ON annee_formation.id_filiere=filiere.id_filiere  where email = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['email'];
   $session_id=$row['id_etudiant'];
   $etudiant_name=$row['prenom_etudiant']." ".$row['nom_etudiant'];
   $nom=$row['nom_etudiant'];
   $prenom=$row['prenom_etudiant'];
   $id_af=$row['annee_formation'];
   $annee_formation=$row['nom_af'];
   $nom_filiere=$row['nom_filiere'];
   
   if(!isset($_SESSION['etudiant'])){
      header("location:etudiant_login.php");
      die();
   }
?>
