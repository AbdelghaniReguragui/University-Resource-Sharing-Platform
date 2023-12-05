<?php
   include('session.php');

?>
 <?php
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

 
// Define variables and initialize with empty values
$filiere = $nom = $prenom = "";
$test="Veuillez remplir le formulaire pour ajouter une filiere";
$filiere_err = $nom_err = $prenom_err = "";
$param_filiere=$param_nom=$param_prenom="";
 
// Processing form data when form is œsubmitted
// if($_POST['ajouter_filiere']){
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if ($_POST['handle']==3){
                $dir="../contenu/".$_POST['nom_fil'];
            
            $sql = "DELETE FROM filiere WHERE id_filiere=? ";
            
            if($stmt = mysqli_prepare($link, $sql)){
            
                        // Set parameters

                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s",  $_POST['id_fil']);
                

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
    else{

 
    // Validate username
    if(empty($_POST["filiere"])){
        $filiere_err = "Veuillez saisir le nom de la filière";
    } else{
        // Prepare a select statement
        $sql = "SELECT nom_filiere FROM filiere WHERE nom_filiere = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_filiere);
            
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
        $sql = "INSERT INTO filiere (nom_filiere) VALUES ( ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
        
                    // Set parameters
            $param_filiere = $filiere;

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $filiere);
            

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
               // header("location: login.php");
               function_alert("Filiére ajoutée");
               
            $structure="../contenu/$filiere";
            if (!is_dir($structure)) {
            mkdir($structure, 0700);
            }
            else
            {
                function_alert("Erreur lors de la création du répertoire");
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





 ?>
<html class="h-100">
   
   <head>
      <title>Gestion filiéres </title>
            <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link href="../bootstrap/style.css" rel="stylesheet">
   </head>
   
   <body class="h-100">
      <script src="../bootstrap/js/bootstrap.min.js"></script>
   <script src="../bootstrap/script.js"></script>
        <div  class="container-fluid pr-0 pl-0 h-100 d-flex flex-column">
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
            
            <div class="container-fluid">
            <div class="panel panel-default bg-light rounded">
            <hr>
            <div class="panel-heading d-flex justify-content-center" >
                <h2 class=" border-bottom text-dark">Ajouter Filiere</h2>
            </div>

            <div class="panel-body d-flex justify-content-center">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-inline">
                    <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                        <label class="control-label mb-2 mr-sm-2 mb-sm-0">Nom de la filiere</label>
                        <input type="text" name="filiere" class="form-control" placeholder="filiere" required>
                    </div>    
                    <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                        <input type="submit" class="btn btn-primary" name="ajouter_filiere" value="Ajouter filiere">
                        <input type="hidden" name="handle" value="0">
                    </div>
            
                </form>
            </div>
            <hr>
            </div>
        
        
        <hr>
        

        <?php

                echo  '   '.
                '<table class="table">

                    <thead class="thead-dark">
                    <tr>
                        <th class="col-sm-12 bg-secondary text-center" colspan="4" scope="col">Liste des filieres</th>

                    </tr>
                    <tr>
                        <th class="col-sm-5" scope="col">Nom de la filiére</th>
                        <th class="col-sm-4" scope="col">Chef de filiére</th>
                        <th class="col-sm-2" scope="col">'."Années de formation".'</th>
                        <th class="col-sm-1" scope="col">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>';
    
        $sql = "SELECT filiere.id_filiere, filiere.nom_filiere, filiere.id_enseignant, enseignant.nom_enseignant,enseignant.prenom_enseignant, count(annee_formation.id_af) as count FROM filiere LEFT JOIN annee_formation ON (filiere.id_filiere=annee_formation.id_filiere)  LEFT JOIN enseignant ON (filiere.id_enseignant=enseignant.id_enseignant) GROUP BY (filiere.id_filiere)" ;
        $result = mysqli_query($link,$sql);

    //   Ordre du jeu de résultats...\n";

            while ($row = $result->fetch_assoc()) {
                $chef_affecte='<td class="col-sm-2" scope="col">'.$row['nom_enseignant'].'</td>
                                <td class="col-sm-2" scope="col">'.$row['prenom_enseignant'].'</td>';
                $chef_non_affecte='<td class="col-sm-2" scope="col">Non affécté</td>
                                <td class="col-sm-2" scope="col">Non affecté</td>';
                if($row['id_enseignant']==""){
                    $chef_filiere_col=$chef_non_affecte;
                
                }
                else{
                    $chef_filiere_col=$chef_affecte;
                }

  
                echo 
    
    
    
      '
<form method="POST" class="form-group" action="editer_filiere.php">
<table class="table">
<tbody>
<tr>
<td class="col-sm-5" scope="col">'.$row['nom_filiere'].'</td>'.$chef_filiere_col.'
<td class="col-sm-2" scope="col">'.$row['count'] .'</td>
<td class="col-sm-1" scope="col">'.'<div class="btn-group-sm btn-group-vertical"><button type="submit" name="update_filiere" class="btn bg-warning">Editer</button> <input value="supprimer" type="button" class="btn bg-danger" onclick="openDeleteForm('."'delete".$row['id_filiere']."'".')"></div>'.'</td>

</tr>
</tbody>
</table>
<input type="hidden" name="id_filiere" value="'.$row['id_filiere'].'">

</form>
<div class="delete-form-popup " id="delete'.$row['id_filiere'].'">
<form action="gestion_filieres.php"  class="form-container" method="post">
<div class="d-flex justify-content-center">





<input type="hidden" name="handle" value="3" >
<input type="hidden" name="id_fil" value="'.$row['id_filiere'].'" >
<input type="hidden" name="nom_fil" value="'.$row['nom_filiere'].'" >


<button type="submit" class="btn bg-danger mb-2 mr-sm-2 mb-sm-0">Confirmer suppression</button>
<button type="button" class="btn bg-success mb-2 mr-sm-2 mb-sm-0" onclick="closeDeleteForm('."'delete".$row['id_filiere']."'".')">Annuler</button>
</div>
</form>
</div>


'
    
    
    
    ;
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
