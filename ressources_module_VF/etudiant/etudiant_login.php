<?php
   include("config.php");
  // include("session.php");
  session_set_cookie_params(3600,"/");
   session_start();
	
 function function_alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
	
	
  if (isset($_SESSION['etudiant'])||!empty($_SESSION['enseignant'])||!empty($_SESSION['admin'])) {
  echo 'Session is active';
  header('Location: deconnexion.php');
}



   $error="";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // email and password sent from form 
      
      $email = mysqli_real_escape_string($link,$_POST['email']);
      $password = mysqli_real_escape_string($link,$_POST['password']); 
      
      $sql = "SELECT * FROM etudiant WHERE email = '$email' and password = '$password'";
      $result = mysqli_query($link,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      if(isset($row)){
      $active = $row['email'];
      }
      
      $count = mysqli_num_rows($result);
      
      // If result matched $email and $password, table row must be 1 row
		
      if($count == 1) {

         
         $_SESSION['etudiant'] = $email;
        function_alert("Vous etes connecte avec succes");
		header("location: etudiant_page.php");
      }else {
         function_alert("mot de passe ou email incoreect,si vous avez oublie votre mot de passe, veuillez contacter l\'dministrateur, email : helpdesk@AbdelghaniSaad.ma");
      }
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      <link rel="stylesheet" href="../bootstrap/css/login.css">
      
   </head>
   
   <body>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
			   <div class="login">
			   <h1>Login etudiant</h1>
                <div class="textbox">
                  <i class="fa fa-user" aria-hidden="true"></i>
				  <input type = "text" placeholder="email" name = "email" class = "box"/>
				</div>
				
                <div class="textbox">
                    <i class="fa fa-lock" aria-hidden="true"></i>
					<input type = "password" placeholder="mot de passe" name = "password" class = "box" />
				</div>
				
                  <input class="button" type="submit" name="login" value="Sing in">
				</div>
               </form>

   </body>
</html>
