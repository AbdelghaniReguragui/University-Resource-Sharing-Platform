<?php
   include('session.php');

?>
 <?php


function function_alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
function af_list() {
    $main_sql = "SELECT *  FROM filiere";
    $main_result = mysqli_query($link,$main_sql);

    while ($main_row = $main_result->fetch_assoc()) {
        echo '<optgroup label="'.$main_row['nom_filiere'].'">';
        $sub_sql = "SELECT *  FROM annee_formation WHERE id_filiere =".$main_row['id_filiere'];
        $sub_result = mysqli_query($link,$sub_sql);

        while ($sub_row = $sub_result->fetch_assoc()) {
            echo '<option value="'.$sub_row['id_af'].'">'.$sub_row['nom_af'].'</option>';
        }

        echo "</optgroup>";

    }
}


 
// Define variables and initialize with empty values
$email = $nom = $prenom = "";
$test="Please fill this form to create an account.";
$email_err = $nom_err = $prenom_err = "";
$param_email=$param_nom=$param_prenom="";
 
// Processing form data when form is submitted
// if($_SERVER["REQUEST_METHOD"] == "POST"){
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $lookfor="";
        if (isset($_POST['rechercher_etudiant'])){
        $lookfor= $_POST['rechercher_etudiant'];
        $_SESSION['lookfor']= $_POST['rechercher_etudiant'];
        
        }
        else{
        $lookfor=$_SESSION['lookfor'];
        
        }

                

    if ($_POST['handle'] == 2){
 ;    $lookfor="";
        if (isset($_POST['rechercher_etudiant'])){
        $lookfor= $_POST['rechercher_etudiant'];
        $_SESSION['lookfor']= $_POST['rechercher_etudiant'];    $lookfor="";
        if (isset($_POST['rechercher_etudiant'])){
        $lookfor= $_POST['rechercher_etudiant'];
        $_SESSION['lookfor']= $_POST['rechercher_etudiant'];
        
        }
        else{
        $lookfor=$_SESSION['lookfor'];
        
        }
        
        }
        else{
        $lookfor=$_SESSION['lookfor'];
        
        }
        if(empty($_POST["nv_email"])){
            $nv_email_err = "Please enter an email.";
        } else{
            // Prepare a select statement
            $sql = "SELECT email FROM etudiant WHERE id_etudiant <> ? AND email = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $_POST['id_etudiant'], $param_email);
                
                // Set parameters
                $param_email = $_POST["nv_email"];
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $nv_email_err = "This email is already taken.";
                        function_alert("Choisissez un autre email");
                    } else{
                        $email = $_POST["nv_email"];
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
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
            $sql = "UPDATE etudiant  SET email = ?, nom_etudiant = ?, prenom_etudiant= ?, annee_formation=? WHERE id_etudiant=? ";
            
            if($stmt = mysqli_prepare($link, $sql)){
            
                        // Set parameters
                $param_email = $email;
                $param_nom = $nom;
                $param_prenom = $prenom;
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssss", $email, $nom, $prenom, $_POST['af'], $_POST['id_etudiant']);
                

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                    
           
                } else{
                    function_alert("Une erreur est survenue");
                }


            }
            else{
                function_alert("Une erreur est survenue");
            }
        }
  //first form
    }
    else if ($_POST['handle'] == 3){
          $sql = "DELETE FROM etudiant WHERE id_etudiant=? ";
            
            if($stmt = mysqli_prepare($link, $sql)){
            
                        // Set parameters
                $param_email = $email;
                $param_nom = $nom;
                $param_prenom = $prenom;
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s",  $_POST['id_etudiant']);
                

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
 
                    function_alert("suppression effectuée");
                } else{
                    function_alert("Une erreur est survenue");
                }


            }
            else{
                function_alert("Une erreur est survenue");
            }
    
    }
        else if ($_POST['handle'] == 5){
          $sql = "UPDATE etudiant SET password='mundiapolis' WHERE id_etudiant=? ";
            
            if($stmt = mysqli_prepare($link, $sql)){
            
                        // Set parameters
                $param_email = $email;
                $param_nom = $nom;
                $param_prenom = $prenom;
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s",  $_POST['id_etudiant']);
                

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

        $sql = "SELECT * FROM etudiant LEFT JOIN annee_formation ON etudiant.annee_formation = annee_formation.id_af LEFT JOIN filiere ON annee_formation.id_filiere=filiere.id_filiere  WHERE lower(nom_etudiant) LIKE CONCAT('%',?,'%') OR lower(prenom_etudiant) LIKE CONCAT('%',?,'%') OR lower(email) LIKE CONCAT('%',?,'%') OR lower(nom_af) LIKE CONCAT('%',?,'%') OR lower(nom_filiere) LIKE CONCAT('%',?,'%')"; 
        

        if($stmt = mysqli_prepare($link, $sql)){
                                 

//             Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $lookfor,  $lookfor,  $lookfor, $lookfor, $lookfor);
//             , $_POST['rechercher_etudiant']);
            

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                $result= mysqli_stmt_get_result($stmt);
//                 mysqli_stmt_store_result($stmt);

            } else{
                function_alert("Une erreur est survenue");
            }

            // Close statement
        //  mysqli_stmt_close($stmt);
        }
    
    
    }
    


        

 
        









 ?>
<html class="h-100">
   
   <head>      
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

   
      <title>Rechercher etudiant </title>
      
            <link href="../bootstrap/style.css" rel="stylesheet">

    </head>
   
   <body class="h-100">

   <script src="../bootstrap/js/bootstrap.min.js"></script>
   <script src="../bootstrap/script.js"></script>
      <div class="container-fluid pr-0 pl-0 h-100 d-flex flex-column">


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="admin_page.php#">Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
    <div class="navbar-nav mr-auto">
      <a class="nav-item nav-link active" href="gestion_etudiants.php">Etudiants<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="gestion_enseignants.php">Enseignants</a>
      <a class="nav-item nav-link" href="gestion_filieres.php">Filieres</a>
               <form action="rechercher_etudiant.php" class="form-inline my-2 my-lg-0" method="post">
            <div>
                
                <input type="text" name="rechercher_etudiant" placeholder="email, nom ou prenom" class="form-control" value="<?php echo $lookfor;?>" required>
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


        <hr>


     
         <a class="btn bg-info text-dark" href = "gestion_etudiants.php">Retour à la liste des etudiants</a>

      <hr>
             

      
    <?php
      

     // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  //  $mysqli->real_query("SELECT nom_enseignant, prenom_enseignant, email FROM enseignant");
   // $res = $mysqli->use_result();

 //   echo "Ordre du jeu de résultats...\n";
 if(isset($result)){
    echo '

        <form action="rechercher_etudiant.php"  method="post">'.
        '<table class="table">
            <thead class="thead-dark">
            <tr>
                <th class="col-sm-2" scope="col">Nom</th>
                <th class="col-sm-2" scope="col">Prenom</th>
                <th class="col-sm-4" scope="col">Email</th>
                <th class="col-sm-1" scope="col">Annee F.</th>
                <th class="col-sm-1" scope="col">Filiere.</th>
                <th class="col-sm-2" scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                                                   </tbody>
</table>
 
            
            
            
            ';

    while ($row = $result->fetch_assoc()) {
        $nom_af=$row['nom_af'];
        $nomfil=$row['nom_filiere'];
        if($row['nom_af']==""){
        $nom_af="NULL";
        $nomfil="NULL";
        }

            
       echo '<table class="table">
       <tbody>
       <tr>
       <td class="col-sm-2">'."" . $row['nom_etudiant'] ."</td>".
        '<td class="col-sm-2">'."" . $row['prenom_etudiant'] ."</td>".
        '<td class="col-sm-4">'."" . $row['email'] ."</td>".
        '<td class="col-sm-1">'."" . $nom_af ."</td>".
        '<td class="col-sm-1">'."" . $nomfil ."</td>".
        '<td class="col-sm-2">'."" . '<div class="btn-group-sm btn-group-vertical"><input value="réinisialiser mot de passe" type="button" class="btn bg-secondary" onclick="openResetForm('."'reset".$row['id_etudiant']."'".')"><input value="modifier" type="button" class="btn bg-warning" onclick="openUpdateForm('."'".$row['id_etudiant']."'".')"> ' ."" . '<input value="supprimer" type="button" class="btn bg-danger" onclick="openDeleteForm('."'delete".$row['id_etudiant']."'".')"></div>'."</td>
        </tr>
        ".

      '<input  style="display: inline;" type="hidden" name="id_etudiant" value="'.$row['id_etudiant'].'" >
                            </tbody>
</table>
          </form>
         
          
          
          
          
          
                <div class="delete-form-popup " id="delete'.$row['id_etudiant'].'">
<form action="rechercher_etudiant.php"  class="form-container" method="post">
    
    
     <div class="d-flex justify-content-center ">
    <input type="hidden" name="handle" value="3" >
    <input type="hidden" name="id_etudiant" value="'.$row['id_etudiant'].'" >
    <button type="submit" class="btn bg-danger border border-primary">Confirmer suppression</button>
    <button type="button" class="btn bg-success border border-primary" onclick="closeDeleteForm('."'delete".$row['id_etudiant']."'".')">Annuler</button>
     </div>
    
</form>
</div>

                <div class="reset-form-popup " id="reset'.$row['id_etudiant'].'">
<form action="gestion_etudiants.php"  class="form-container" method="post">
    
    
     <div class="d-flex justify-content-center ">
    <input type="hidden" name="handle" value="5" >
    <input type="hidden" name="id_etudiant" value="'.$row['id_etudiant'].'" >
    <button type="submit" class="btn bg-danger border border-primary">Confirmer réinisialisation</button>
    <button type="button" class="btn bg-success border border-primary" onclick="closeResetForm('."'reset".$row['id_etudiant']."'".')">Annuler</button>
     </div>
    
</form>
</div>
       


<div class="update-form-popup bg-warning" id="'.$row['id_etudiant'].'">
  <form action="rechercher_etudiant.php"  class="form-container" method="post">


     <table class="table">
       <tbody>
       <tr>   
    

    <td class="col-sm-2"><input type="text" value="'.$row['nom_etudiant'].'" placeholder="nouveau nom" name="nv_nom" required></td>
    
        
    <td class="col-sm-2"><input type="text" value="'.$row['prenom_etudiant'].'" placeholder="nouveau prenom" name="nv_prenom" required></td>
    
       <td class="col-sm-4"> <input type="email" value="'.$row['email'].'" placeholder="nouvel email" name="nv_email" required></td>

    
                    <input type="hidden" name="handle" value="2" >
                                        <input type="hidden" name="id_etudiant" value="'.$row['id_etudiant'].'" >
                                                        <td class="col-sm-2"><select id="af_choix" name="af">

                                        ';

    $main_sql = "SELECT *  FROM filiere";
    $main_result = mysqli_query($link,$main_sql);

    while ($main_row = $main_result->fetch_assoc()) {
    
        echo '<optgroup label="'.$main_row['nom_filiere'].'">';
        $sub_sql = "SELECT *  FROM annee_formation WHERE id_filiere =".$main_row['id_filiere'];
        $sub_result = mysqli_query($link,$sub_sql);

        while ($sub_row = $sub_result->fetch_assoc()) {
            if ($sub_row['id_af']==$row['id_af']){
                $option=$selected;
            } 
            else{
            $option="";
            }
            echo '<option value="'.$sub_row['id_af'].'"'.$option. '>'.$sub_row['nom_af'].'</option>';
        }

        echo "</optgroup>";

    }

    echo '                </select></td>
    <td class="col-sm-2">
<button type="submit" class="btn bg-danger">Modifier</button>
    <button type="button" class="btn cancel bg-success" onclick="closeUpdateForm('."'".$row['id_etudiant']."'".')">Annuler</button>
    </td>
</tr>
</tbody>
</table>
  </form>
</div>

';
}
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
