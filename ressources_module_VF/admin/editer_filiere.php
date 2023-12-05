<?php
   include('session.php');
?>
    <?php
    
    $nom_fil="";
    $prenom_chef_fil="";
    $nom_chef_fil="";
    $email_chef_fil="";
     function function_alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
    
function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
       }
     }
     reset($objects);
     rmdir($dir);
   }
}


    if(isset($_POST['id_filiere'])||isset($_SESSION['id_filiere'])){
        if(isset($_POST['id_filiere'])){
            $fil=$_POST['id_filiere'];
            $_SESSION['id_filiere']=$fil;
            }
            else{
                $fil=$_SESSION['id_filiere'];
            }
        
        $sql = "SELECT * FROM filiere WHERE id_filiere=".$fil;
        $result = mysqli_query($link,$sql);

                $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
                $_SESSION['id_filiere']=$fil;
                $_SESSION['nom_filiere']= $row['nom_filiere'];
                $nom_fil=$row['nom_filiere'];
                if($row['id_enseignant']==""){

                }
                else {
                    $sql = "SELECT * FROM enseignant WHERE id_enseignant =" .$row['id_enseignant'];
                    $result = mysqli_query($link,$sql);

                    
                    
                        
                            /* store result */
                            $chef_filiere=mysqli_fetch_array($result,MYSQLI_ASSOC);
    //                         mysqli_stmt_fetch($stmt)
                           
                                            $prenom_chef_fil=$chef_filiere['prenom_enseignant'];
                $nom_chef_fil=$chef_filiere['nom_enseignant'];
                $email_chef_fil=$chef_filiere['email'];
                        
                    
                
                }
            }
            else echo "Aucune filiere n'est selectionnée";

    

    ?>
 <?php

 
// Define variables and initialize with empty values
$annee_formation= $nom = $prenom = "";
$test="";
$annee_formation_err = $nom_err = $prenom_err = "";
$param_af=$param_nom=$param_prenom="";
 
// Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['handle'])){

            if ($_POST['handle'] == 1){
            
                // Validate username
                if(empty($_POST["annee_formation"])){
                    $annee_formation_err = "Veuillez saisir le nom de l'annee de formation";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT * FROM annee_formation WHERE nom_af = ? AND id_filiere=$fil";
                    
                    if($stmt = mysqli_prepare($link, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_af);
                        
                        // Set parameters
                        $param_af = $_POST["annee_formation"];
                        
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            /* store result */
                            mysqli_stmt_store_result($stmt);
                            
                            if(mysqli_stmt_num_rows($stmt) == 1){
                                $annee_formation_err = "existe deja";
                                function_alert("Veuillez saisir un autre nom");
                            } else{
                                $annee_formation= $_POST["annee_formation"];
                            }
                        } else{
                            function_alert("Une erreur est survenue");
                        }

                        // Close statement
                    //  mysqli_stmt_close($stmt);
                    }
                }
                

                
                // Check input errors before inserting in database
                if(empty($annee_formation_err)){
                    
                    // Prepare an insert statement
                    $sql = "INSERT INTO annee_formation (nom_af, id_filiere) VALUES ( ?, ?)";
                    
                    if($stmt = mysqli_prepare($link, $sql)){
                    
                                // Set parameters
                        $param_af = $annee_formation;

                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "ss", $annee_formation,$fil);
                        

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            // Redirect to login page
                        // header("location: login.php");
                        $chemin="../contenu/".$_SESSION['nom_filiere']."/$annee_formation";
                        
                        
                                        if (!is_dir($chemin)) {
                        mkdir($chemin, 0700);
                        }
                        else
                        {
                            function_alert("Une erreur est survenue lors de la création du répertoire");
                        }
                        
                        

                            function_alert("Année de formation ajoutée");
                        } else{
                           function_alert("Une erreur est survenue");;
                        }

                        // Close statement
            //             mysqli_stmt_close($stmt);$conn
                    }
                    else{
                        function_alert("Une erreur est survenue");
                    }
                }
            }
            
            if ($_POST['handle'] == 2){
        
                // Validate username
                if(empty($_POST["nv_nom"])){
                    $annee_formation_err = "Veuillez saisir le nom de l'annee de formation";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT * FROM annee_formation WHERE nom_af = ? AND id_filiere=$fil AND id_af<>".$_POST['id_af'];
                    
                    if($stmt = mysqli_prepare($link, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_af);
                        
                        // Set parameters
                        $param_af = $_POST["nv_nom"];
                        
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            /* store result */
                            mysqli_stmt_store_result($stmt);
                            
                            if(mysqli_stmt_num_rows($stmt) == 1){
                                $annee_formation_err = "existe deja";
                                function_alert("Veuillez saisir un autre nom");
                            } else{
                                $annee_formation= $_POST["nv_nom"];
                            }
                        } else{
                           function_alert("Une erreur est survenue");
                        }

                        // Close statement
                    //  mysqli_stmt_close($stmt);
                    }
                }
                

                
                // Check input errors before inserting in database
                if(empty($annee_formation_err)){
                    
                    // Prepare an insert statement
                    $sql = "UPDATE annee_formation SET nom_af=? WHERE id_af= ?";
                    
                    if($stmt = mysqli_prepare($link, $sql)){
                    
     
                        $param_af = $annee_formation;

                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "ss", $annee_formation,$_POST['id_af']);
                        

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                        
                        $chemin="../contenu/".$_SESSION['nom_filiere']."/$annee_formation";
                                        $ancienchemin="../contenu/".$_SESSION['nom_filiere']."/".$_POST['ancien_nom'];

                        
                        
                                        if (!is_dir($chemin)) {
                                        rename ($ancienchemin, $chemin);

                        }
                        else
                        {
                            function_alert("Une erreur est survenue durant la création du répertoire");
                        }
                        
                        

                        function_alert("Modification");
                        } else{
                            function_alert("Une erreur est survenue");
                        }

                    }
                    else{
                        function_alert("Une erreur est survenue");
                    }
                }
            
            
            
            }
            
            else if ($_POST['handle']==3){
                $dir="../contenu/".$_POST['nom_fil']."/".$_POST['nom_af'];
            
            $sql = "DELETE FROM annee_formation WHERE id_af=? ";
            
            if($stmt = mysqli_prepare($link, $sql)){
            
                        // Set parameters

                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s",  $_POST['id_af']);
                

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                // header("location: login.php");
                    function_alert("Année de formation supprimé avec succés");
                    rrmdir($dir);
                } else{
                    function_alert("Une erreur est survenuue");
                }

                // Close statement
    //             mysqli_stmt_close($stmt);$conn
            }
            else{
                function_alert("Une erreur est survenue");
            }
            
            
            }
        else if ($_POST['handle']==6){
        
    // Validate username
    if(empty($_POST["filiere"])){
        $filiere_err = "Veuillez saisir le nom de la filière";
    } else{
        // Prepare a select statement
        $sql = "SELECT nom_filiere FROM filiere WHERE nom_filiere = ? AND id_filiere <> ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_filiere, $_POST['id_filiere']);
            
            // Set parameters
            $param_filiere = $_POST["filiere"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $filiere_err = "This filiere is already taken.";
                    function_alert("Choisissez un autre nom de filiére");
                } else{
                    $filiere = $_POST["filiere"];
                }
            } else{
                function_alert("Une erreur est survenue");
            }

        }
    }
    

    
    // Check input errors before inserting in database
    if(empty($filiere_err)){
        
        // Prepare an insert statement
        $sql = "Update filiere SET nom_filiere = ? WHERE id_filiere =  ?";
         
        if($stmt = mysqli_prepare($link, $sql)){
        
                    // Set parameters
            $param_filiere = $filiere;

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $filiere, $_POST['id_filiere']);
            

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
               // header("location: login.php");
               function_alert("Filiére modifiée");
               
                    $_SESSION['nom_filiere']=$_POST['filiere'];
                    $nom_fil=$_POST['filiere'];
            
            
            
                                    $chemin="../contenu/".$filiere;
                                        $ancienchemin="../contenu/".$_POST['ancien_nom'];

                        
                        
                                        if (!is_dir($chemin)) {
                                        rename ($ancienchemin, $chemin);

                        }
                        else
                        {
                            function_alert("Une erreur est survenue durant la création du répertoire");
                        }


            } else{
                function_alert("Une erreur est survenue");
            }

        }
        else{
            function_alert("Une erreur est survenue");
        }
    }
            

            
            
            }
                
        }
    }
 
        
        








 ?>
<html class="h-100">
   
   <head>
      <title>Editer filiére </title>
      <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link href="../bootstrap/style.css" rel="stylesheet">
      <style>
            .update-form-popup,.delete-form-popup {
  display: none;

}
      </style>
      
      <script>

</script>


   </head>
   
   <body class="h-100">
        <div  class="container-fluid pr-0 pl-0 h-100 d-flex flex-column ">

   
            <nav class="navbar navbar-expand-lg navbar-dark  bg-dark">
                <a class="navbar-brand" href="admin_page.php">Admin</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                    <div class="navbar-nav mr-auto">
                        <a class="nav-item nav-link " href="gestion_etudiants.php">Etudiants</a>
                        <a class="nav-item nav-link " href="gestion_enseignants.php">Enseignants<span class="sr-only">(current)</span></a>
                        <a class="nav-item nav-link active" href="gestion_filieres.php">Filieres</a>
                    </div>
                    <div class="navbar-nav ml-auto">
                        <span class="nav-item nav-link"><?php echo $admin_name; ?></span>
                        <a class="nav-item nav-link bg-danger rounded" href = "admin_logout.php">Deconnexion</a>
                    </div>
                </div>
            </nav>
      <script language="JavaScript">

    

</script>
   <script src="../bootstrap/js/bootstrap.min.js"></script>
   <script src="../bootstrap/script.js"></script>
<hr>
        <div class="container-fluid">

       <h2><a class="btn btn-info col-12" href = "gestion_filieres.php">Retour à la liste des filiéres</a></h2>
       
       
          
        <div class="panel panel-default bg-light rounded">
            <hr>
            <div class="panel-heading d-flex justify-content-center" >
                <h2 class=" border-bottom text-dark">Ajouter année de formation</h2>
            </div>

            <div class="panel-body d-flex justify-content-center">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-inline">
                    <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                        <label class="control-label mb-2 mr-sm-2 mb-sm-0">Nom de l'année de formation</label>
                        <input type="text" name="annee_formation" class="form-control" placeholder="année de formation" required value="<?/*php echo $filiere;*/ ?>">
                    </div>    
                    <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                        <input type="submit" class="btn btn-primary" name="ajouter_filiere" value="Ajouter filiere">
                        <input type="hidden" name="id_filiere" value="<?php echo $fil; ?>"> 
                        <input type="hidden" name="handle" value="1" >
                    </div>
            
                </form>
            </div>
            <hr>
        </div>

    
        <div class="d-flex justify-content-center  ">
        <div class="w-50 p-3">
            <table class="table border border-dark">
        
                <tbody class="thead-dark">
                    <tr>
                <th class="col-3" scope="col">Filiére</th>

                <td class="col-sm-3" scope="col"><?php echo $nom_fil; ?></td>
                </tr> 
                <tr>
                <th class="col-3" scope="col">Chef de filiere</th>

                <td class="col-sm-3" scope="col"><?php echo $nom_chef_fil."  ".$prenom_chef_fil; ?></td>
                
            </tr>
            <tr>
                <th class="col-3" scope="col">Email</th>

                <td class="col-sm-3" scope="col"><?php echo $email_chef_fil; ?></th>
   
   
            </tr>
                                                   </tbody>
            </table>
            </div>
            
        
        
        </div>
        <button type="button" class="btn bg-success col-12" onclick="openUpdate()">Modifier</button>
        
        <div id="updateName" class="panel panel-default bg-light rounded">
            <hr>
            <div class="panel-heading d-flex justify-content-center" >
                <h2 class=" border-bottom text-dark">mofifier le nom de la filiére</h2>
            </div>

            <div class="panel-body d-flex justify-content-center">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-inline">
                    <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                        <label class="control-label mb-2 mr-sm-2 mb-sm-0">Nom de l'année de formation</label>
                        <input type="text" name="filiere" class="form-control" placeholder="filiere" required value="<?/*php echo $filiere;*/ ?>">
                    </div>    
                    <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                        <input type="submit" class="btn btn-warning mb-2 mr-sm-2 mb-sm-0" name="ajouter_filiere" value="Modifier">
                        <input type="hidden" name="id_filiere" value="<?php echo $fil; ?>">
                                                <input type="hidden" name="ancien_nom" value="<?php echo $nom_fil; ?>"> 

                                    <button type="button" class="btn bg-success mb-2 mr-sm-2 mb-sm-0" onclick="cancelUpdate()">Annuler</button>

                        <input type="hidden" name="handle" value="6" >
                    </div>
            
                </form>
            </div>
            <hr>
        </div>
        <hr>
        
        <div class="d-flex justify-content-center ">
            <a href = "editer_chef_de_filiere.php" class="btn bg-info col-12"> Modifier chef de filiere</a>
        </div>
        </br>
    
    
   

    
    
    

        
  

        
        
        
        
        
        
        <?php
        
                        echo  '   '.
        '<table class="table">
        
            <thead class="thead-dark">
            <tr>
                <th class="col-sm-9" scope="col">'."Nom de l'année de formation".'</th>

                <th class="col-sm-3" scope="col">Action</th>
   
            </tr>
            </thead>
            <tbody>
                                                   </tbody>
</table>';
      
      $sql = "SELECT * FROM annee_formation WHERE id_filiere=".$fil;
      $result = mysqli_query($link,$sql);
     // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  //  $mysqli->real_query("SELECT nom_enseignant, prenom_enseignant, email FROM enseignant");
   // $res = $mysqli->use_result();

 //   echo "Ordre du jeu de résultats...\n";
    while ($row = $result->fetch_assoc()) {
//         echo " nom : " . $row['nom_af'] .'<div method="POST" id="'.$row['id_af'].'"><form name="modifier_af"" onsubmit="show_update()">
//    <input type="submit" value="modifier af" />
// </form>'.'</div> <br>';
 echo '<form action="editer_filiere.php"   method="post">'.
 
 
 
         '<table class="table">
        
            <tbody>
            <tr>
                <td class="col-sm-9" scope="col">'. $row['nom_af'] .'</td>

                <td class="col-sm-3" scope="col">  <div class="btn-group-sm btn-group-horizontal">  <input value="'."Liste d'Etudiants".'" type="button" class="btn bg-primary" onclick="submitForm('."'myForm".$row['id_af']."'".')">    <input value="modifier" type="button" class="btn bg-warning" onclick="openUpdateForm('."'".$row['id_af']."'".')">
        <input value="supprimer" type="button" class="btn bg-danger" onclick="openDeleteForm('."'delete".$row['id_af']."'".')"></div></td>
   
            </tr>
            
                                                   </tbody>
</table>'
 
 
 
 .' 
        
       
        <input  type="hidden" name="id_af" value="'.$row['id_af'].'" >
                            <input type="hidden" name="handle" value="3" >
    <div class="edit_af " >
          </form>
          
                        <form id="myForm'.$row['id_af'].'" method="post" action="liste_etudiants.php">
      <input type=submit value="Submit" name="mySubmit">
              <input  type="hidden" name="id_af" value="'.$row['id_af'].'" >
                            <input type="hidden" name="handle" value="4" >
    </form>
    </div>

          

       


       
       <div class="delete-form-popup " id="delete'.$row['id_af'].'">
  <form action="editer_filiere.php"  class="form-container" method="post">
    <div class="d-flex justify-content-center">

    


    
                    <input type="hidden" name="handle" value="3" >
                                        <input type="hidden" name="id_af" value="'.$row['id_af'].'" >
<input type="hidden" name="nom_af" value="'.$row['nom_af'].'" >
<input type="hidden" name="nom_fil" value="'.$nom_fil.'" >


    <button type="submit" class="btn bg-danger mb-2 mr-sm-2 mb-sm-0">Confirmer suppression</button>
    <button type="button" class="btn bg-success mb-2 mr-sm-2 mb-sm-0" onclick="closeDeleteForm('."'delete".$row['id_af']."'".')">Annuler</button>
    </div>
  </form>
</div>
       
       
       
       
<div class="update-form-popup bg-warning" id="'.$row['id_af'].'">
  <form action="editer_filiere.php"  class="form-container" method="post">'.

           '<table class="table">
        
            <tbody>
            <tr>
                <td class="col-sm-9" scope="col"><input type="text" value="'.$row['nom_af'].'" placeholder="nouveau nom" name="nv_nom" required></td>

                <td class="col-sm-3" scope="col">            <button type="submit" class="btn bg-danger">Modifier</button>
    <button type="button" class="btn bg-success" onclick="closeUpdateForm('."'".$row['id_af']."'".')">Annuler</button></td>
   
            </tr>
            
                                                   </tbody>
</table>'.


'
                        <input type="hidden" name="ancien_nom" value="'.$row['nom_af'].'" >

    


    
                    <input type="hidden" name="handle" value="2" >
                                        <input type="hidden" name="id_af" value="'.$row['id_af'].'" >



  </form>
</div>
<hr>

';
    }
    
    
           
    
    
    ?>
        <hr>
    
            </div>
            <footer id="footer" class="d-flex justify-content-center mt-auto py-4 bg-dark text-white-50 ">
                <div class="text-center">
                    <small>Copyright &copy; Abdelghani & Saad</small>
                </div>
            </footer>
        </div>
   </body>
   
</html>
