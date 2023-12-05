<?php
   include('session.php');

?>
 <?php

 

 
// Processing form data when form is œsubmitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST['handle']==2){
            $sql="UPDATE filiere SET id_enseignant=".$_POST['id_enseignant']." WHERE id_filiere=".$_SESSION['id_filiere'];
            mysqli_query($link, $sql);
        }
        else if($_POST['handle']==1){
            $sql="UPDATE filiere SET id_enseignant= NULL WHERE id_filiere=".$_SESSION['id_filiere'];
            mysqli_query($link, $sql);        
        }
    }


 ?>
 
 
<html class="h-100">
   
   <head>
      <title>Editer chef de filiere </title>
            <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link href="../bootstrap/style.css" rel="stylesheet">
   </head>
   
   <body class="h-100">
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

   
      <hr>
 <h2><a class="btn bg-primary" href = "editer_filiere.php">Retourner à la filiére</a></h2>

    
    
    <?php
        if(isset($_SESSION['id_filiere'])){
            
            $sql = "SELECT * FROM enseignant WHERE id_enseignant = ( SELECT id_enseignant FROM filiere WHERE id_filiere =" .$_SESSION['id_filiere'].")";
            $result = mysqli_query($link,$sql);



            if(mysqli_num_rows($result)==1){
                /* store result */
                $chef_filiere=mysqli_fetch_array($result,MYSQLI_ASSOC);
            }
            //                         mysqli_stmt_fetch($stmt)
            if(isset($chef_filiere)){
                $nom_chef_fil=$chef_filiere['nom_enseignant'];
                $prenom_chef_fil=$chef_filiere['prenom_enseignant'];
                $email_chef_fil=$chef_filiere['email'];
            }
            else{
                $nom_chef_fil="NULL";
                $prenom_chef_fil="NULL";
                $email_chef_fil="NULL";
            }
            
    ?>
    
    
    
      <hr>
              <div class="d-flex justify-content-center  ">
        <div class="w-50 p-3">
            <table class="table border border-dark">
        
                <tbody class="thead-dark">
                <tr>
                <th colspan="2" class="col-6 text-center" scope="col">Chef de filiére</th>
                </tr>
                    <tr>
                <th class="col-1" scope="col">Nom</th>

                <td class="col-sm-3" scope="col"><?php echo $nom_chef_fil; ?></td>
                </tr> 
                <tr>
                <th class="col-1" scope="col">Prénom</th>

                <td class="col-sm-3" scope="col"><?php echo $prenom_chef_fil; ?></td>
                
            </tr>
            <tr>
                <th class="col-1" scope="col">Email</th>

                <td class="col-sm-3" scope="col"><?php echo $email_chef_fil; ?></th>
   
   
            </tr>
                                                   </tbody>
            </table>
            
            <form action="editer_chef_de_filiere.php" class="form-inline my-2 my-lg-0" method="post">
                    
                    <input type="submit" class="btn btn-danger " value="Supprimer chef de filiére">
                    <input type="hidden" name="handle" value="1" >


            
            </form>
            </div>
        </div>
        

      

      

    <?php
    
                            echo  '   '.
        '<table class="table">
        
            <thead class="thead-dark">
            <tr>
            <th colspan="4" class="col-6 text-center">Liste des enseignants libres</th>
            </tr>
            <tr>
                <th class="col-sm-3" scope="col">'."Nom de l'enseignant".'</th>

                <th class="col-sm-3" scope="col">'."Prenom de l'enseignant".'</th>
                <th class="col-sm-4" scope="col">'."Email".'</th>

                <th class="col-sm-2" scope="col">Action</th>
   
            </tr>
            </thead>
            <tbody>
                                                   </tbody>
</table>';
            
            $sql = "SELECT * FROM enseignant WHERE id_enseignant NOT IN (SELECT id_enseignant FROM filiere WHERE id_enseignant IS NOT NULL)";
                   
            $result = mysqli_query($link,$sql);
            // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            //  $mysqli->real_query("SELECT nom_enseignant, prenom_enseignant, filiere FROM enseignant");
            // $res = $mysqli->use_result();

            //   echo "Ordre du jeu de résultats...\n";

            while ($row = $result->fetch_assoc()) {
                echo '<form method="POST" action="editer_chef_de_filiere.php">
                                    <input type="hidden" name="handle" value="2" >

                    <input type="hidden" name="id_enseignant" value="'.$row['id_enseignant'].'">
                    
                    '.
                    
                    '
            <table class="table">
        
            <tbody>
            <tr>
                <td class="col-sm-3" scope="col">'.$row['nom_enseignant'].'</td>

                <td class="col-sm-3" scope="col">'.$row['prenom_enseignant'].'</td>
                <td class="col-sm-4" scope="col">'.$row['email'].'</td>

                <td class="col-sm-2" scope="col"><input type="submit" class="btn bg-success" name="update_chef_filiere" value="Affecter"></td>
   
            </tr>

            <tbody>
            </tbody>

            </table>
            </form>
                    '
                    
                    
                    
                    ;
            }
        }
        else{
        echo "aucune filiere n'est select";
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
