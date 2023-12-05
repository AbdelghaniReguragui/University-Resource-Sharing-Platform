<?php
   include('session.php');
?>
<html class="h-100">
   
   <head>
        <title>Acceuil Enseignant </title>
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
            
            
             <div class="container-fluid">
             
             
             
             
             
            <hr>
             

                

	    <?php
		$sql = "select * from filiere where id_enseignant = '$id_enseignant'";
		
		$result = mysqli_query($link,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
      
		if($count == 1) {
		
            echo '<div class="card text-center" >
                    <div class="card-header">
                        Cheft de filiére
                    </div>
                 ';
			echo '
			<form method="POST" action="chef_filiere_page.php">
			<input type= "hidden"  name="id_chef_filiere" value= "'.$row['id_enseignant'].'" > 
			<input type= "hidden"  name="id_filiere" value= "' .$row['id_filiere']. '" > 
			<input type= "hidden"  name="nom_filiere" value= "' .$row['nom_filiere']. '" > 
			
                <div class="card-body">
			      <h5 class="card-title">'.$row['nom_filiere'].'</h5>
    <input class="btn btn-success" type="submit" name="chef_filiere" value="Gérer">
                </div>
                </div>
                </form>
			
			';
			
	
		}
	  ?>
	  <hr>
	  <?php

        $sql = "select * from element_module where id_enseignant = '$id_enseignant'";
        $result = mysqli_query($link,$sql);
        $count = mysqli_num_rows($result);
        
        if($count>0){

            echo '<div class="card ">
                    <div class="card-header text-center">
                        Vos cours
                    </div>
  <ul class="list-group list-group-flush">

    
';
            while ($row = $result->fetch_assoc()) {


                echo '<li class="list-group-item"><form method="POST" action="editer_element_module_enseignant.php"> <h5 class="card-title">'.$row['nom_element_module'].'</h5><input class="form-control mr-sm-2 btn btn-primary" type="submit" name="update_element_module" value="modifier element module">
                <input type="hidden" name="id_element_module" value="'.$row['id_element_module'].'">
                <input type="hidden" name="nom_element_module" value="'.$row['nom_element_module'].'">
             
                
                </form>'."</li>";
            }
            echo '  </ul>
                </div>';
        }
?>
             </div>
                <footer id="footer" class="d-flex justify-content-center mt-auto py-4 bg-primary text-white-50 ">
                    <div class="text-center">
                        <small>Copyright &copy; Abdelghani & Saad</small>
                    </div>
                </footer>
        </div>
   </body>
   
</html>
