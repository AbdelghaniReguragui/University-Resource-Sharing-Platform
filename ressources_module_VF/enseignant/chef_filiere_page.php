<?php
   include('session.php');

	$id_filiere = "";
	$nom_filiere = "";
	if ( (isset($_POST['id_filiere']) &&  isset($_POST['nom_filiere']) ) || ( isset($_SESSION['id_filiere']) ) ){
		
		if(isset($_POST['id_filiere'])){
			$id_filiere = $_POST['id_filiere'];
			$nom_filiere = $_POST['nom_filiere'];
			$_SESSION['id_filiere'] = $id_filiere ;
		}
		else{
			$id_filiere = $_SESSION['id_filiere'];
			$nom_filiere = $_SESSION['nom_filiere'] ;
		}
	}
?>

<html class="h-100">
   
   <head>
        <title>Gestion de filere : <?php echo $nom_filiere ;?>  </title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap/style.css" rel="stylesheet">
   </head>
   
   <body class="h-100">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/script.js"></script>
        <div  class="container-fluid pr-0 pl-0 h-100 d-flex flex-column">
            <nav class="navbar navbar-expand-lg navbar-dark  bg-primary d-flex">
                <a class="navbar-brand" href="enseignant_page.php">Accueil</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                    <div class="navbar-nav mr-auto">    
                    </div>
                    <div style="text-center; color:white">
                        <center><span> Espace Enseignant</span></center>
                    </div>
                    <div class="navbar-nav ml-auto">
                        <a class="nav-item nav-link bg-info mb-2 mr-sm-2 mb-sm-0" href = "profile_update.php"><?php echo $prenom_enseignant." ".$nom_enseignant;  ?></a>
                        <a class="nav-item nav-link bg-danger rounded" href = "enseignant_logout.php">Deconnexion</a>
                    </div>
                </div>
            </nav>
            
            
             <div class="container-fluid h-100" style="background-color:#e6f0ff;">
   <br>
   <br>
	  <h1><center><span class="badge badge-pill badge-primary mb-5"><?php echo $nom_filiere ; ?></span> </center></h1>
<!--	  
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
                            </div>
                        </div>-->
        
        <table class="table">
        
            <thead class="thead-dark">
            <tr>
            <th colspan="2" class="col-12 text-center">Liste des années de formations</th>
            </tr>
            <tr>
                <th class="col-sm-10 " scope="col">Année de formation</th>

                <th class="col-sm-2 text-center" scope="col">Action</th>

   
            </tr>
            </thead>
            <tbody>
        </tbody>
</table>

<?php
      
      $sql = "SELECT * FROM annee_formation WHERE id_filiere= '$id_filiere'";
      $result = mysqli_query($link,$sql);
     // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  //  $mysqli->real_query("SELECT nom_enseignant, prenom_enseignant, email FROM enseignant");
   // $res = $mysqli->use_result();

 //   echo "Ordre du jeu de résultats...\n";
    while ($row = $result->fetch_assoc()) {
        echo '<form method="POST" action="editer_annee_formation.php">
          <table class="table">
       <tbody>
       <tr>
       <td class="col-sm-10">'."" .  $row['nom_af']."</td>".
       '<td class="col-sm-2">'."" .'<input type="submit" class="btn" style="background-color:#e6e6ff;" name="update_af" value="Gérer'." l'année ".'de formation">' ."</td>".
       "</td></tr>".
       
       
       
       '
                                   </tbody>
</table>
    <input type="hidden" name="id_af" value="'.$row['id_af'].'"><br>
	<input type="hidden" name="nom_af" value="'.$row['nom_af'].'"><br>
    
	</form>'."<br>";;
    }
    ?>
	  <br>
	
            </div>
            <footer id="footer" class="d-flex justify-content-center mt-auto py-4 bg-primary text-white-50 ">
                <div class="text-center">
                <small>Copyright &copy; Abdelghani & Saad</small>
                </div>
            </footer>
        </div>
	</body>
</html>
