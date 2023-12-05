<?php
   session_start();
   
   if(session_destroy()) {
      header("Location: enseignant_login.php");
   }
?>
