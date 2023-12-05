<?php
   include('session.php');

?>
 <?php


function function_alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
 
// Define variables and initialize with empty values
$email = $nom = $prenom = "";
$test="Please fill this form to create an account.";
$email_err = $nom_err = $prenom_err = "";
$param_email=$param_nom=$param_prenom="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($_POST['handle'] == 1) {
                
  //first form

        // Validate username
        if(empty($_POST["email"])){
            $email_err = "Please enter an email.";
        } 
        else{
            // Prepare a select statement
            $sql = "SELECT email FROM enseignant WHERE email = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                
                // Set parameters
                $param_email = $_POST["email"];
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $email_err = "This email is already taken.";
                        function_alert("Cet email existe deja");
                    } else{
                        $email = $_POST["email"];
                    }
                } 
                else{
                    function_alert("Une erreur est survenue");
                }

            }
        }
        
        if(empty($_POST["nom"])){
            $nom_err = "Please enter a nom.";     

        } else{
            $nom = $_POST["nom"];
        }
        
        if(empty($_POST["prenom"])){
            $prenom_err = "Please prenom.";     

        }
        else{
            $prenom=$_POST["prenom"];
        }
        
        // Check input errors before inserting in database
        if(empty($email_err) && empty($nom_err) && empty($prenom_err)){
            
            // Prepare an insert statement
            $sql = "INSERT INTO enseignant (email, nom_enseignant, prenom_enseignant) VALUES (?, ?, ?)";
            
            if($stmt = mysqli_prepare($link, $sql)){
            
                        // Set parameters
                $param_email = $email;
                $param_nom = $nom;
                $param_prenom = $prenom;
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss", $email, $nom, $prenom);
                

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    function_alert("Enseignant ajouté avec succés");
                

                } else{

                }

            }

        }
    }
                

    else if ($_POST['handle'] == 2){
            // Validate username

        if(empty($_POST["nv_email"])){
            $nv_email_err = "Please enter an email.";
        } else{
            // Prepare a select statement
            $sql = "SELECT email FROM enseignant WHERE id_enseignant <> ? AND email = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $_POST['id_enseignant'], $param_email);
                
                // Set parameters
                $param_email = $_POST["nv_email"];
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $nv_email_err = "This email is already taken.";
                        function_alert("Cet email existe deja");
                    } else{
                        $email = $_POST["nv_email"];
                    }
                } else{
                    function_alert("Une erreur est survenue");
                }
            }
        }
        
        // Validate password
        if(empty($_POST["nv_nom"])){
            $nv_nom_err = "Please enter a nom.";     

        } else{
            $nom = $_POST["nv_nom"];
        }
        
        // Validate confirm password
        if(empty($_POST["nv_prenom"])){
            $nv_prenom_err = "Please prenom.";     

        }
        else{
            $prenom=$_POST["nv_prenom"];
        }
        
        // Check input errors before inserting in database
        if(empty($nv_email_err) && empty($nv_nom_err) && empty($nv_prenom_err)){
            
            // Prepare an insert statement
            $sql = "UPDATE enseignant  SET email = ?, nom_enseignant = ?, prenom_enseignant= ? WHERE id_enseignant=? ";
            
            if($stmt = mysqli_prepare($link, $sql)){
            
                        // Set parameters
                $param_email = $email;
                $param_nom = $nom;
                $param_prenom = $prenom;
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssss", $email, $nom, $prenom, $_POST['id_enseignant']);
                

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
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
    else if ($_POST['handle'] == 3){
          $sql = "DELETE FROM enseignant WHERE id_enseignant=? ";
            
            if($stmt = mysqli_prepare($link, $sql)){
            
                        // Set parameters
                $param_email = $email;
                $param_nom = $nom;
                $param_prenom = $prenom;
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s",  $_POST['id_enseignant']);
                

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                    function_alert("Enseignant supprimé avec succés");
                } else{
                    function_alert("Une erreur est survenue");
                }

                // Close statement
    //             mysqli_stmt_close($stmt);$conn
            }
            else{
                function_alert("Une erreur est survenue");
            }
    
    }
        else if ($_POST['handle'] == 5){
          $sql = "UPDATE enseignant SET password='mundiapolis' WHERE id_enseignant=? ";
            
            if($stmt = mysqli_prepare($link, $sql)){
            
                        // Set parameters
                $param_email = $email;
                $param_nom = $nom;
                $param_prenom = $prenom;
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s",  $_POST['id_enseignant']);
                

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    function_alert("Mot de passe réinisialisé");
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
      <title>Gestion enseignants </title>
            <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link href="../bootstrap/style.css" rel="stylesheet">

      <style>


      </style>
   </head>
   
   <body class="h-100">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/script.js"></script>
   <div  class="container-fluid pr-0 pl-0 h-100 d-flex flex-column">
   


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="admin_page.php">Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
    <div class="navbar-nav mr-auto">
      <a class="nav-item nav-link " href="gestion_etudiants.php">Etudiants</a>
      <a class="nav-item nav-link active" href="gestion_enseignants.php">Enseignants<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="gestion_filieres.php">Filieres</a>
 
        
        
                      <form action="rechercher_enseignant.php" class="form-inline my-2 my-lg-0"  method="post">
            <div>
                
                <input type="text" name="rechercher_enseignant" placeholder="email, nom ou prenom" class="form-control"  required>
            </div>    
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Rechercher">
                <input type="hidden" name="handle" value="4" >

            </div>
           
        </form>
        
    </div>
    <div class="navbar-nav ml-auto">
        <span class="nav-item nav-link"><?php echo $admin_name; ?></span>
        <a class="nav-item nav-link bg-danger rounded" href = "admin_logout.php">Deconnexion</a>
    </div>
  </div>
</nav>




    
    
    <div class="container-fluid">


   
        <div class="container-fluid bg-light">

    

        <hr>
                <div class="d-flex justify-content-center bg-light" >
        <h2 class="  border-bottom">Ajouter enseignant</h2>
        </div>
          <div class="d-flex justify-content-center">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form-inline" method="post">
 
            <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                <label class="control-label mb-2 mr-sm-2 mb-sm-0" for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>    
            <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                <label class="control-label mb-2 mr-sm-2 mb-sm-0" for="nom">nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>
            <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                <label class="control-label mb-2 mr-sm-2 mb-sm-0" for="Prenom">prenom</label>
                <input type="text" name="prenom" class="form-control" required="required"  >
            </div>
            <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                <input type="submit" class="btn btn-primary" value="Ajouter">
                <input type="hidden" name="handle" value="1" >

            </div>
           
        </form>
    </div>
    
    
    

   
    
    
      <hr>
      </div>
      
    <?php
        echo  '   '.
        '<table class="table">
            <thead class="thead-dark">
            <tr>
                <th class="col-sm-2" scope="col">Nom</th>
                <th class="col-sm-2" scope="col">Prenom</th>
                <th class="col-sm-6" scope="col">Email</th>
                <th class="col-sm-2" scope="col">Action</th>
   
            </tr>
            </thead>
            <tbody>
                                                   </tbody>
</table>';
      
      $sql = "SELECT *  FROM enseignant";
      $result = mysqli_query($link,$sql);

    while ($row = $result->fetch_assoc()) {
        echo '<form action="gestion_enseignants.php"  class="form-container" " method="post">'.' 
        
          <table class="table">
       <tbody>
       <tr>
       <td class="col-sm-2">'."" . $row['nom_enseignant'] ."</td>".
       '<td class="col-sm-2">'."" . $row['prenom_enseignant'] ."</td>".
       '<td class="col-sm-6">'."" . $row['email'] ."</td>".
       '<td class="col-sm-2">'."" . '<div class="btn-group-sm btn-group-vertical"><button type="button" class="btn bg-secondary" onclick="openResetForm('."'reset".$row['id_enseignant']."'".')">Réinitialiser mot de passe><button type="button" class="btn bg-warning" onclick="openUpdateForm('."'".$row['id_enseignant']."'".')">Modifier</button>
        <button  value="supprimer" type="button" class="btn bg-danger" onclick="openDeleteForm('."'delete".$row['id_enseignant']."'".')">Supprimer</button> </div>' .
        "</td></tr>".
       
       
       '
                                   </tbody>
</table>
       

        <input  style="display: inline;" type="hidden" name="id_enseignant" value="'.$row['id_enseignant'].'" >
                            <input type="hidden" name="handle" value="3" >

          </form>
          
          
          
   
          
          
<div class="delete-form-popup" id="delete'.$row['id_enseignant'].'">
    <form action="gestion_enseignants.php"  class="form-container" method="post">
        <div class="d-flex justify-content-center ">
        <input type="hidden" name="handle" value="3" >
        <input type="hidden" name="id_enseignant" value="'.$row['id_enseignant'].'" >
        <button type="submit" class="btn bg-danger border border-primary">Confirmer suppression</button>
        <button type="button" class="btn bg-success border border-primary" onclick="closeDeleteForm('."'delete".$row['id_enseignant']."'".')">Annuler</button>
        </div>
    </form>
</div>


<div class="reset-form-popup" id="reset'.$row['id_enseignant'].'">
    <form action="gestion_enseignants.php"  class="form-container" method="post">
        <div class="d-flex justify-content-center ">
        <input type="hidden" name="handle" value="5" >
        <input type="hidden" name="id_enseignant" value="'.$row['id_enseignant'].'" >
        <button type="submit" class="btn bg-danger border border-primary">Confirmer Réinitialisation</button>
        <button type="button" class="btn bg-success border border-primary" onclick="closeResetForm('."'reset".$row['id_enseignant']."'".')">Annuler</button>
        </div>
    </form>
</div>
       


<div class="update-form-popup bg-warning" id="'.$row['id_enseignant'].'">
  <form action="gestion_enseignants.php"  class="form-container" method="post">
  <table class="table">
       <tbody>
       <tr>
       <td class="col-sm-2">'."" . '<input type="text" value="'.$row['nom_enseignant'].'" placeholder="nouveau nom" name="nv_nom" required>'."</td>".
       '<td class="col-sm-2">'."" . '<input type="text" value="'.$row['prenom_enseignant'].'" placeholder="nouveau prenom" name="nv_prenom" required>'."</td>".
       '<td class="col-sm-6">'."" . '<input type="email" value="'.$row['email'].'" placeholder="nouvel email" name="nv_email" required>' ."</td>".
       '<td class="col-sm-2">'."" . '<button type="submit" class="btn bg-danger">Confirmer</button>
        <button type="button" class="btn bg-success" onclick="closeUpdateForm('."'".$row['id_enseignant']."'".')">Annuler</button>' ."</td></tr>".
       
       
       
       '
        </tbody>
    </table>

                    <input type="hidden" name="handle" value="2" > <input type="hidden" name="id_enseignant" value="'.$row['id_enseignant'].'" >

  </form>
</div>
<hr>

';
    }
    ?>
    </div>
      <footer id="footer" class="d-flex justify-content-center mt-auto py-4 bg-dark text-white-50 ">
    <div class="text-center">
      <small>Copyright &copy; Abdelghani & Saad</small>
    </div>
  </footer>
  </div>
       
   </body>
   
</html>
