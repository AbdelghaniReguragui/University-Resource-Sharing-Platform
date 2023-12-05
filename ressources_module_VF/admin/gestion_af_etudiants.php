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
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if ($_POST['handle'] == 1) {

  //first form

        // Validate username
        if(empty($_POST["email"])){
            $email_err = "Please enter an email.";
        } 
        else{
            // Prepare a select statement
            $sql = "SELECT email FROM etudiant WHERE email = ?";
            
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
                         function_alert("Choisissez un autre email");
                    } else{
                        $email = $_POST["email"];
                    }
                } 
                else{
                     function_alert("Une erreur est survenue");
                }

            }
        }
        
        // Validate password
        if(empty($_POST["nom"])){
            $nom_err = "Please enter a nom.";     

        } else{
            $nom = $_POST["nom"];
        }
        
        // Validate confirm password
        if(empty($_POST["prenom"])){
            $prenom_err = "Please prenom.";     

        }
        else{
            $prenom=$_POST["prenom"];
        }
        
        // Check input errors before inserting in database
        if(empty($email_err) && empty($nom_err) && empty($prenom_err)){
            
            // Prepare an insert statement
            $sql = "INSERT INTO etudiant (email, nom_etudiant, prenom_etudiant, annee_formation) VALUES (?, ?, ?, ?)";
            
            if($stmt = mysqli_prepare($link, $sql)){
            
                        // Set parameters
                $param_email = $email;
                $param_nom = $nom;
                $param_prenom = $prenom;
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssss", $email, $nom, $prenom, $_POST['af']);
                

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    function_alert("Etudiant ajouté avec succées");
                } else{
                    function_alert("Une erreur est survenue");
                }

            }

        }
    }
                

    else if ($_POST['handle'] == 2){
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
                       
                    } else{
                        $email = $_POST["nv_email"];
                    }
                } else{
                     function_alert("Erreur ");
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
                // header("location: login.php");
                     function_alert("Modification enregistrée");
                } else{
                    function_alert("Erreur de modification");

                }

            }
            else{
            }
        }
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
                    // Redirect to login page
                // header("location: login.php");
                     function_alert("Suppression enregistrée");
                } else{
                    function_alert("Erreur de suppression");

                }

                // Close statement
    //             mysqli_stmt_close($stmt);$conn
            }
            else{
                function_alert("Erreur");

            }
    
    }
    }
    




 ?>
<html">
   
   <head>
      <title>Gestion enseignants </title>
      <style>
      .form-popup {
  display: none;

}<hr
      </style>
   </head>
   
   <body>
   <script>

</script>
      <h1>Welcome <?php echo $login_session; ?></h1> 
      <hr>
         <h2><a href = "admin_page.php">Precedent</a></h2>

      <hr>
         <hr>
              <form action="rechercher_etudiant.php"  method="post">
            <div>
                
                <input type="text" name="rechercher_etudiant" placeholder="email, nom ou prenom" class="form-control" value="<?/*php echo $email;*/ ?>" required>
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Rechercher">
                <input type="hidden" name="handle" value="4" >

            </div>
           
        </form>

    
    
    

   
    
    
      <hr>
          <div class="wrapper">
        <h2>ajouter etudiant</h2>
        <p><?php echo $test; ?></p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post">
            <div>
                <label>email</label>
                <input type="text" name="email" class="form-control" value="<?/*php echo $email;*/ ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>    
            <div >
                <label>nom</label>
                <input type="text" name="nom" class="form-control" value="<?/*php echo $nom;*/ ?>">
                <span class="help-block"><?php echo $nom_err; ?></span>
            </div>
            <div>
                <label>prenom</label>
                <input type="text" name="prenom" class="form-control" required="required" oninvalid="this.setCustomValidity('ach had chi')" value="<?/*php echo $prenom;*/ ?>">
                <span class="help-block"><?php echo $prenom_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
                <input type="hidden" name="handle" value="1" >
                <select id="af_choix" name="af">

                <?php
//                       $sql = "SELECT *  FROM filiere";
//                         $result = mysqli_query($link,$sql);
// 
//                         while ($row = $result->fetch_assoc()) {
//                             echo '<optgroup label="'.$row['nom_filiere'].'">';
//                             $sub_sql = "SELECT *  FROM annee_formation WHERE id_filiere =".$row['id_filiere'];
//                             $sub_result = mysqli_query($link,$sub_sql);
// 
//                             while ($sub_row = $sub_result->fetch_assoc()) {
//                                 echo '<option value="'.$sub_row['id_af'].'">'.$sub_row['nom_af'].'</option>';
//                             }
//                         
//                             echo "</optgroup>";
//                         
//                         }
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
                ?>
                

                </select>     
                
                Ajouter Etudiant
                

            </div>
           
        </form>
    </div>
    
    
    

   
    
    
      <hr>
      
    <?php
      
      $sql = "SELECT *  FROM etudiant LEFT JOIN annee_formation ON  etudiant.annee_formation=annee_formation.id_af LEFT JOIN filiere ON annee_formation.id_filiere=filiere.id_filiere";
      $result = mysqli_query($link,$sql);
     // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  //  $mysqli->real_query("SELECT nom_enseignant, prenom_enseignant, email FROM enseignant");
   // $res = $mysqli->use_result();

 //   echo "Ordre du jeu de résultats...\n";
    while ($row = $result->fetch_assoc()) {
        $nom_af=$row['nom_af'];
        if($row['nom_af']=="")$nom_af="Non affectéé";
        echo '<form action="gestion_etudiants.php"  style="margin: 0; padding: 0;" " method="post">'." nom : " . $row['nom_etudiant'] . "\n"."               prenom : ".$row['prenom_etudiant'] ."               email : ".$row['email']."\tannee_formation : ".$nom_af.' 
        
        <input value="modifier" type="button" class="open-button" onclick="openForm('."'".$row['id_etudiant']."'".')">
        <button type="submit" class="btn">Supprimer</button>
        <input  style="display: inline;" type="hidden" name="id_etudiant" value="'.$row['id_etudiant'].'" >
                            <input type="hidden" name="handle" value="3" >

          </form>
       


<div class="form-popup" id="'.$row['id_etudiant'].'">
  <form action="gestion_etudiants.php"  class="form-container" method="post">
    <h1>Modifier etudiant</h1>

        <label for="pernom"><b>Email</b></label>
    <input type="text" value="'.$row['email'].'" placeholder="nouvel email" name="nv_email" required>
    

        <label for="nom"><b>Nom</b></label>
    <input type="text" value="'.$row['nom_etudiant'].'" placeholder="nouveau nom" name="nv_nom" required>
    
        <label for="pernom"><b>Prenom</b></label>
    <input type="text" value="'.$row['prenom_etudiant'].'" placeholder="nouveau prenom" name="nv_prenom" required>
    
                    <input type="hidden" name="handle" value="2" >
                                        <input type="hidden" name="id_etudiant" value="'.$row['id_etudiant'].'" >
                                                        <select id="af_choix" name="af">

                                        ';

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

    echo '                </select>
<button type="submit" class="btn">Modifier</button>
    <button type="button" class="btn cancel" onclick="closeForm('."'".$row['id_etudiant']."'".')">Annuler</button>
  </form>
</div>
<hr>

';
    }
    ?>
        <hr>
      <h2><a href = "admin_logout.php">Sign Out</a></h2>
   </body>
   
</html>
