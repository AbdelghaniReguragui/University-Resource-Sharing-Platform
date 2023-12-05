<?php
include('session.php');
    function function_alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
   if($_SERVER["REQUEST_METHOD"] == "POST"){
            // Validate username


            // Prepare a select statement
            $sql = "SELECT * FROM etudiant WHERE id_etudiant = ? AND password = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $session_id, $_POST['mdp']);
                
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $carryOn=1;
                    } else{
                        function_alert("Mot de passe érroné");
                        $carryOn=0;

                        
                    }
                } else{
                    function_alert("Une erreur est survenue");
                }

                // Close statement
            //  mysqli_stmt_close($stmt);
            }
            echo mysqli_error($link);
        
        
 
        
        // Check input errors before inserting in database
        if($carryOn==1){
            
            // Prepare an insert statement
            $sql = "UPDATE etudiant  SET password = ? WHERE id_etudiant=? ";
            
            if($stmt = mysqli_prepare($link, $sql)){
            
                        // Set parameters
   
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $_POST['nv_mdp'], $session_id);
                

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                // header("location: login.php");
                    function_alert("Modification enregistrée");
                } else{
                    function_alert("Une erreur est survenue");
                }


            }
            else{
                function_alert("Une erreur est survenue");
            }
        }
  
    }




?>


<html class="h-100">
   
   <head>
      <title><?php echo $nom_element_module ; ?></title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap/style.css" rel="stylesheet">
	<script> 
	</script>
   </head>
   
   <body class="h-100">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/script.js"></script>
        <div  class="container-fluid pr-0 pl-0 h-100 d-flex flex-column">
            <nav class="navbar navbar-expand-lg navbar-dark  bg-primary d-flex">
                <a class="navbar-brand" href="etudiant_page.php">Acceuil</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                    <div class="navbar-nav mr-auto">
                        <a class="nav-item nav-link " href="etudiant_ressources.php">Ressources<span class="sr-only">(current)</span></a>                    </div>
                    <div class="navbar-nav  d-flex justify-content-center">
                        <span class="text-center" > Espace Etudiant</span>

                    </div>
                    <div class="navbar-nav ml-auto">
                        <a class="nav-item nav-link bg-info mb-2 mr-sm-2 mb-sm-0" href = "profile_update.php"><?php echo $etudiant_name; ?></a>
                        <a class="nav-item nav-link bg-danger rounded" href = "etudiant_logout.php">Deconnexion</a>
                    </div>
                </div>
            </nav>
            
            
             <div class="container-fluid  h-100 " style="background-color:#e6f0ff;">
   <br>
   <br>
	      <div class="d-flex justify-content-center  ">
        <div class="w-50 p-3">
            <table class="table border border-dark">
        
                <tbody class="thead-dark">
                    <tr>
                <th class="col-3" scope="col">Filiére</th>

                <td class="col-sm-3" scope="col"><?php echo $nom_filiere; ?></td>
                </tr> 
                <tr>
                <th class="col-3" scope="col">Année deformation</th>

                <td class="col-sm-3" scope="col"><?php echo $annee_formation; ?></td>
                
            </tr>
            <tr>
                <th class="col-3" scope="col">Email</th>

                <td class="col-sm-3" scope="col"><?php echo $login_session; ?></th>
   
   
            </tr>
            <tr>
                <th class="col-3" scope="col">Nom</th>

                <td class="col-sm-3" scope="col"><?php echo $nom; ?></th>
   
   
            </tr>
            <tr>
                <th class="col-3" scope="col">Prénom</th>

                <td class="col-sm-3" scope="col"><?php echo $prenom; ?></th>
   
   
            </tr>
                                                   </tbody>
            </table>
            </div>
            
        
        
    </div>
    <div class="d-flex justify-content-center">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form-inline" method="post">
 
            <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                <label class="control-label mb-2 mr-sm-2 mb-sm-0" >Ancien mot de passe</label>
                <input type="password" name="mdp" placeholder="Ancien mot de passe" class="form-control"  required>
            </div>    
            <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                <label class="control-label mb-2 mr-sm-2 mb-sm-0" >Nouveau mot de pass</label>
                <input type="password" name="nv_mdp" placeholder="Nouveau mot de passe" class="form-control" required>
            </div>
  
            <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                <input type="submit" class="btn btn-primary" value="Confirmer">
                <input type="hidden" name="handle" value="1" >

            </div>
           
        </form>
    </div>
    
    
	  
	  
  
	 

            </div>
            <footer id="footer" class="d-flex justify-content-center mt-auto py-4 bg-primary text-white-50 ">
                <div class="text-center">
                <small>Copyright &copy; Abdelghani & Saad</small>
                </div>
            </footer>
        </div>
	</body>
</html>
