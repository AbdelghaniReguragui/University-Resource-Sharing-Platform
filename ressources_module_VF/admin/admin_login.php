<?php
   include("config.php");
  // include("session.php");
  session_set_cookie_params(3600,"/");
   session_start();
  
  if (isset($_SESSION['admin'])||!empty($_SESSION['etudiant'])||!empty($_SESSION['enseignant'])) {
  echo 'Session is active';
  header('Location: deconnexion.php');
}
 function function_alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}


   $error="";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // email and password sent from form 
      
      $email = mysqli_real_escape_string($link,$_POST['email']);
      $password = mysqli_real_escape_string($link,$_POST['password']); 
      
      $sql = "SELECT * FROM admin WHERE email = '$email' and password = '$password'";
      $result = mysqli_query($link,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      if(isset($row)){
      $active = $row['email'];
      }
      
      $count = mysqli_num_rows($result);
      
      // If result matched $email and $password, table row must be 1 row
		
      if($count == 1) {

         
         $_SESSION['admin'] = $email;
        function_alert("Vous etes connecte avec succes");
		header("location: admin_page.php");
      }else {
         function_alert("mot de passe ou email incoreect,si vous avez oublie votre mot de passe, veuillez contacter l\'administrateur, email : helpdesk@AbdelghaniSaad.ma");
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
			   <h1>Login admin</h1>
                <div class="textbox">
                  <i class="fa fa-user" aria-hidden="true"></i>
				  <input type = "email" name = "email" placeholder="email" class = "box" required/>
				</div>
				
                <div class="textbox">
                    <i class="fa fa-lock" aria-hidden="true"></i>
					<input type = "password" name = "password" placeholder="mot de passe" class = "box"  required/>
				</div>
				
				
                 <input class="button" type="submit" name="login" value="Sing in"> 
				</div>
               </form>
            <!-- end header -->

   </body>
</html>
